<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Login page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
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
        $validated = $request->validated();
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (auth()->attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }
}
