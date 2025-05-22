<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //this is a comment to learn commit as in learning.
    public function login()
    {
        return 'test login';
    }
//this is a comment
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

