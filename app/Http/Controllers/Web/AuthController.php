<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
}
