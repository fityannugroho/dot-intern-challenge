<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * Login handler
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (!auth()->attempt($credentials)) {
            return $this->fail('Unauthorized', 401);
        }

        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;

        return $this->success([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::now()->addMinutes((int) config('sanctum.expiration'))->toDateTimeString()
        ], 'Login successful', 201);
    }

    /**
     * Logout handler
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = User::find(auth()->user()->id);
        $isDeleted = $user->tokens()->delete();

        if ($isDeleted) {
            return $this->success(null, 'Logout successful', 200);
        }

        return $this->fail('Failed to logout', 500);
    }
}
