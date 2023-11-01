<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenApi extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'base_domain', 'access_token', 'expires', 'refresh_token', 'resource_owner_id', 'values'];
}
