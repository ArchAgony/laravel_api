<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use Exception;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        try {
            Authentication::create([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'name' => $request->input('name')
            ]);
            return response()->json([
                'message' => 'Account has been created successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'The email field is required.',
                'error' => [
                    'email' => 'the email field is required',
                    'password' => 'the password field is required',
                    'name' => 'the name field is required'
                ]
            ], 422);
        }
    }
}
