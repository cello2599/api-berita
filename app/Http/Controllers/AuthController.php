<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login 
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                
                $token = $user->createToken($request->username)->plainTextToken;
                return $token;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Password Salah'
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Username Tidak Ditemukan',
                'data' => ''
            ], 400);
        }
    }

    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil Logout'
        ], 200);
    }
}
