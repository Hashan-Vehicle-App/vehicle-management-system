<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function showLogin() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where('username', $request->username)->first();

        if (Hash::check($request->password, $user->password)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput()->withErrors(['message' => 'Invalid credentials']);
    }

    public function showDashboard() {
        return view('admin.dashboard');
    }
}