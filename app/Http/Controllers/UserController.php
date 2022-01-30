<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $newUser->userRole = $request->userRole;
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
}
