<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthService;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * The auth service instance.
     */
    protected $authService = null;

    /**
     * Create a new controller instance.
     *
     * @param AuthService $authService The auth service instance.
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login handler
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!$this->authService->login($request)) {
            return $this->fail('Unauthorized', 401);
        }

        $token = $this->authService->createAccessToken();
        $tokenExpiresAt = Carbon::parse(auth()->user()->tokens->first()->expires_at)->toDateTimeString();

        return $this->success([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => $tokenExpiresAt,
        ], 'Login successful', 201);
    }

    /**
     * Logout handler
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if ($this->authService->logout()) {
            return $this->success(null, 'Logout successful', 200);
        }

        return $this->fail('Failed to logout', 500);
    }
}
