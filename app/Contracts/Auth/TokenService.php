<?php

namespace App\Contracts\Auth;

use App\Models\User;

interface TokenService
{

    /**
     * @param User $user
     * @return array
     */
    public function generateToken(User $user): array;

    /**
     * @param User $user
     * @return void
     */
    public function revokeToken(User $user): void;

    /**
     * @param User $user
     * @return void
     */
    public function revokeAllTokens(User $user): void;

    /**
     * @param string $token
     * @return bool
     */
    public function verifyToken(string $token): bool;
}
