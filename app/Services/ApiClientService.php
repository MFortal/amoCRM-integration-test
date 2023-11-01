<?php

namespace App\Services;

use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Grant\RefreshToken;
use App\Models\TokenApi;
use Carbon\Carbon;
use Exception;

class ApiClientService
{
    private $provider;

    protected $apiClient;
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $baseDomain;

    public function __construct()
    {
        $this->clientId = env('CLIENT_ID');
        $this->clientSecret = env('CLIENT_SECRET');
        $this->redirectUri = env('CLIENT_REDIRECT_URI');
        $this->baseDomain = env('BASE_DOMAIN');

        $apiClient = new AmoCRMApiClient($this->clientId, $this->clientSecret, $this->redirectUri);
        $apiClient->setAccountBaseDomain($this->baseDomain);
        $this->apiClient = $apiClient;

        $this->provider = new ProviderAmoService();
    }

    public function createOrUpdateAccessToken()
    {
        if ($token = TokenApi::where('client_id', $this->clientId)->where('base_domain', $this->baseDomain)->first()) {
            if (Carbon::now() >= $token->expires) {
                $this->refreshAccessToken($token);
                $token->refresh();
            }
        } else {
            $token = $this->createAccessToken();
        }

        $this->apiClient->setAccessToken(new AccessToken([
            'access_token' => $token->access_token,
            'resource_owner_id' => $token->resource_owner_id,
            'refresh_token' => $token->refresh_token,
            'expires' => $token->expires,
            'values' => json_decode($token->values),
        ]));
    }

    private function createAccessToken()
    {
        $token = $this->provider->getAccessToken('authorization_code', ['code' => env('AUTHORIZATION_CODE')]);

        $tokenApi = TokenApi::create([
            'client_id' => $this->clientId,
            'base_domain' => $this->baseDomain,
            'access_token' => $token->getToken(),
            'refresh_token' => $token->getRefreshToken(),
            'expires' => Carbon::createFromTimestamp($token->getExpires())->toDateTimeString(),
            'resource_owner_id' => $token->getResourceOwnerId(),
            'values' => json_encode($token->getValues())
        ]);

        return $tokenApi;
    }

    private function refreshAccessToken(TokenApi $token)
    {
        try {
            $accessToken = $this->provider->getAccessToken(new RefreshToken(), [
                'refresh_token' => $token->refresh_token,
            ]);

            $token->access_token = $accessToken->getToken();
            $token->refresh_token = $accessToken->getRefreshToken();
            $token->expires = Carbon::createFromTimestamp($accessToken->getExpires())->toDateTimeString();
            $token->resource_owner_id = $accessToken->getResourceOwnerId();
            $token->values = json_encode($accessToken->getValues());
            $token->save();
        } catch (Exception $e) {
            die((string)$e);
        }

        return $token;
    }

    public function getLeadsService()
    {
        return $this->apiClient->leads();
    }
}
