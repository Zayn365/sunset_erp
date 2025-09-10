<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate(['email' => ['required'], 'password' => ['required']]);
        $login = $request->input('email');
        $pass  = $request->input('password');

        // Try as email or kod; provider reads 'password' and compares to 'sifre'
        $attempts = [
            ['mail' => $login, 'password' => $pass],
            ['kod'  => $login, 'password' => $pass],
        ];

        foreach ($attempts as $creds) {
            if (Auth::attempt($creds, false)) { // NO remember (no remember_token column)
                $request->session()->regenerate();
                return redirect()->intended(route('home'));
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
