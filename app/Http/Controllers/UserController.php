<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request) {
        $existingUsers = User::all()->where('username', $request->username);

        if(count($existingUsers)) {
            return response()->json([
                'status' => false,
                'message' => 'Username already exists',
            ]);
        }

        $newUser = new User;

        $newUser->username = $request->username;
        $newUser->user_role = $request->userRole;
        $newUser->password = Hash::make($request->password);

        $result = $newUser->save();

        if($result) {
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error in creating user'
            ]);
        }
    }

    public function login(Request $request) {
        $user = User::where('username', $request->username)->first();

        if(Hash::check($request->password, $user->password)) {
            $token = $user->createToken('api_token')->plainTextToken;

            $user->tokens()->delete();

            $response = ['data' => new UserResource($user)];
        } 

        return response($response, 200);
    }

    // Logout for all users
    public function logout(Request $request) {
        $user = Auth::user();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($user->user_role === 'admin') {
            return redirect()->route('adminLogin');
        } 

        return redirect()->route('clientLogin');
    }
}