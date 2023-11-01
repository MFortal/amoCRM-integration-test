<?php

namespace App\Services;

use AmoCRM\OAuth2\Client\Provider\AmoCRM;

class ProviderAmoService
{
    protected $provider;
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

        $this->provider = new AmoCRM([
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret,
            'redirectUri' => $this->redirectUri,
        ]);
        $this->provider->setBaseDomain($this->baseDomain);
    }
}
