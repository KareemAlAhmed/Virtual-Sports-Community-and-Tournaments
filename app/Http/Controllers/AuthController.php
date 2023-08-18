<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginReq;
use App\Http\Requests\siginReq;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(siginReq $request){
        $user=new User;
        $user->name=$request->input("name");
        $user->password=$request->input("password");
        $user->password=bcrypt($user->password);
        $user->bio=$request->input("bio");
        $user->email=$request->input("email");
        $user->save();
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
        Auth::login($user);
        return response($response,201);
        // return redirect('/');
    }
    function login(Request $request){
        //check the email
        $user= User::where('email',$request->input('email'))->first();
            
        //check the the password
        if(!$user || !Hash::check($request->input('password'),$user->password)){
           return ['error'=>'the email or password doesnt exist!'] ;
        }
        
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        Auth::login($user);
        // return response($response,201);
        return redirect('/');
    }
    function logout(Request $request){
        auth()->user()->tokens()->delete();
        return ['message'=>'logout succesfuly'];

    }
}
