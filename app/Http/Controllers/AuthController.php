<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function me(){
        return[
            'NIS' => 3103120161,
            'Nama' => 'Nayla Rahma',
            'Phone' => '08818779205'
        ];
    }

    public function register(Request $request){
        $field = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
             'password' =>  'required|string|confirmed|min:6'
        ]);

        $user = User::create([
            'name'=> $field['name'],
            'email'=> $field['email'],
            'password' => bcrypt($field['password'])
        ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    public function login(Request $request)
    {
        $field = $request->validate([
            'email' => 'required|string',
            'password' =>  'required|string'
        ]);

        // Check email
        $user = User::where('email', $field['email'])->first();

        // Check password
        if (!$user || !Hash::check($field['password'], $user->password)) {
            return response([
                'message' => 'unauthorized'
            ], 401);

        }

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {

        // $request->user()->currentAccessToken()->delete();
        auth('sanctum')->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}