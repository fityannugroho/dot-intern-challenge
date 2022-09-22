<?php

namespace App\Http\Services;

use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthService
{
    /**
     * Login handler.
     *
     * @param LoginRequest $requests The login request.
     * @return bool true if login successful, false otherwise.
     */
    public function login(LoginRequest $request): bool
    {
        $validated = $request->validated();
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        return auth()->attempt($credentials);
    }

    /**
     * Create access token for the logged in user.
     *
     * @return string The access token. If the user is not logged in, return empty string.
     */
    public function createAccessToken(): string
    {
        $user = User::find(auth()->id());

        if (empty($user)) {
            return '';
        }

        return $user->createToken('authToken')->plainTextToken;
    }

    /**
     * Revoke the access token of the logged in user.
     *
     * @return bool true if the token is revoked, false otherwise.
     */
    public function revokeAccessToken(): bool
    {
        $user = User::find(auth()->id());

        if (empty($user)) {
            return false;
        }

        return $user->tokens()->delete();
    }
}
