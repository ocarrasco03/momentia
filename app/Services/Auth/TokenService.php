<?php

namespace App\Services\Auth;

use App\Contracts\Auth\TokenService as TokenServiceContract;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class TokenService implements TokenServiceContract
{
    public function generateToken(User $user): array
    {
        $token      = $user->createToken(config('app.name'));
        $plainToken = $token->plainTextToken;
        $model      = $token->accessToken;

        $model->expires_at = now()->addMinutes(config('session.lifetime'));
        $model->save();

        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        return [
            'access_token'  => $plainToken,
            'expires_at'    => $model->expires_at,
        ];
    }

    public function revokeToken(User $user): void
    {
        /** @var PersonalAccessToken|null $token */
        $token = $user->currentAccessToken();

        $token?->delete();
    }

    public function revokeAllTokens(User $user): void
    {
        $user->tokens()->delete();
    }

    public function verifyToken(Request $token): bool
    {
        $tkn = $token->user()->currentAccessToken();

        if ($tkn && $tkn->expires_at && $tkn->expires_at->isPast()) {
            return true;
        }

        return false;
    }
}
