<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password =$request->input('password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $email)->first();

        if(!$user || !Hash::check($password, $password ? $user->password: ''))
        {
            return response()->json([
                'message' => 'Invalid email or password!'
            ], 401);
        }

        //revoke old tokens
        $user->tokens()->delete();

        $user->token = $user->createToken('access')->plainTextToken;

        return response()->json([
            'user' => $user,
        ]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
}
