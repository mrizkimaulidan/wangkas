<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Show the login form.
     *
     * @return View
     * @author Muhammad Rizki Maulidan <mrizkimaulidanx@gmail.com>
     */
    public function showLoginForm(): View
    {
        return view('authentication.login');
    }

    /**
     * Authenticate user from login page with credentials.
     *
     * @param Request $request
     * @return void
     * @author Muhammad Rizki Maulidan <mrizkimaulidanx@gmail.com>
     */
    public function login(Request $request)
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->with('error', 'Email atau password salah!');
    }
}
