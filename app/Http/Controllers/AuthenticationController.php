<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:authentications,email',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
            // kalau mau ada minimal karakter pass nya
        ]);

        if ($validator->fails()) {
            return response()->json([
                //kalau mau pake ini nanti pesan errornya jadi 2
                // 'message' => 'Email has been registered.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = Authentication::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name'  => $request->name,
        ]);

        return response()->json([
            'message' => 'Registration successful.',
            'data' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return response()->json(['message' => 'Login failed.'], 401);
        }

        return response()->json(['message' => 'Login successful.'], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully.'], 200);
    }
    public function getUsers()
    {
        $users = Authentication::all();
        return response()->json($users, 200);
    }
}
