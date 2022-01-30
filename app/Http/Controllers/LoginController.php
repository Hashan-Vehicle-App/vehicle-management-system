<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            // If username not found in the database
            return invalidCredentials();
        } else {
            // If username found in the database
            if (Hash::check($request->password, $user->password)) {
                // If username and the password match
                // return response()->json([
                //     'message' => 'Valid login'
                // ]);
                return redirect('/admin/dashboard');
            } else {
                // If password is not correct
                return invalidCredentials();
            }
        }
    }
}

function invalidCredentials() {
    return back()->withInput()->withErrors(['message' => 'Invalid credentials']);
}
