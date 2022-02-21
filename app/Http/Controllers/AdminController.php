<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function login() {
        
        if (Auth::check()) {
            // If user logged in already
            return redirect()->route('adminDashboard');
        }

        return view('admin.login');
    }

    public function doLogin(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('adminDashboard'));
        }

        return back()->withInput()->withErrors(['message' => 'Invalid credentials']);
    }

    public function showDashboard() {
        return view('admin.dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('adminLogin');
    }
}