<?php

namespace App\Services\Auth;

use \App\Contracts\Auth\CredentialValidatorService as CredentialValidatorServiceContract;
use Illuminate\Http\Request;

class CredentialValidatorService implements CredentialValidatorServiceContract
{
    public function isExpired(Request $refreshToken): bool
    {
        $token = $refreshToken->user()->currentAccessToken();

        if (!$token->isExpired()) {
            return true;
        }

        return false;
    }
}
