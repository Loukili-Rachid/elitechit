<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('client');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        // dd(Auth::guard('client')->attempt($credentials));
        if (Auth::guard('client')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('cart')->with('success', 'You have been successfully logged in!');

        }

        // Authentication failed...
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
