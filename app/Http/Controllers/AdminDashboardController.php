<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('surveyor')) {
            return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
        }
        elseif (Auth::user()->hasRole('superadmin')){
            return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
        }
        return view('admin.dashboard');
    }
}
