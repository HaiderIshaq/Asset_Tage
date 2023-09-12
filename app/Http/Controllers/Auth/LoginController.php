<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->hasRole('superadmin')) {
                return redirect()->route('superadmin.dashboard');
            } elseif (Auth::user()->hasRole('surveyor')) {
                return redirect()->route('surveyor.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
