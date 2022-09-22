<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
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
     * Login page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        // If the user is already logged in, redirect to the dashboard page.
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        $data['title'] = 'Login';
        return view('pages.login', $data);
    }

    /**
     * Login action
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAction(LoginRequest $request)
    {
        if (!$this->authService->login($request)) {
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        return redirect()->intended('dashboard');
    }
}
