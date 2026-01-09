<?php

namespace App\Contracts\Auth;

use Illuminate\Http\Request;

interface CredentialValidatorService
{
    /**
     * Validate token expiration
     *
     * @param Request $refreshToken
     * @return bool
     */
    public function isExpired(Request $refreshToken): bool;
}
