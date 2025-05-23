<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return 'test login';
    }

    public function logout (Request $request)
    {
    }
    public function register(Request $request)
    {
         $request->validate([
            'name'=> 'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $existingUser=User::where('email',$request->email)->exists();
        if($existingUser)
        {
            throw ValidationException::withMessages([
                'email'=>'Email already in use'
            ]);
        }
        User :: create($request->all());
        return response()->json([
            'message'=>'User created Successfully'
        ]);
    }
}

