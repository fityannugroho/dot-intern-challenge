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
        $user = User::find(auth()->user()->id);

        if (empty($user)) {
            return '';
        }

        return $user->createToken('authToken')->plainTextToken;
    }

    /**
     * Logout the current authenticated user.
     *
     * @return bool true if logout successful, false otherwise.
     */
    public function logout(): bool
    {
        $user = User::find(auth()->user()->id);
        return $user->tokens()->delete();
    }
}
