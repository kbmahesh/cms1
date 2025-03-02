<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.management_login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('management')->attempt($credentials)) {
            return redirect()->route('management.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout management user
    public function logout()
    {
        Auth::guard('management')->logout();
        return view('/management/management-login');
    }
}
