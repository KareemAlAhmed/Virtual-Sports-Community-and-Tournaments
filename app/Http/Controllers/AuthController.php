<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginReq;
use App\Http\Requests\siginReq;
use App\Models\Acheivements;
use App\Models\Leagues;
use App\Models\Tournaments;
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
        return response()->json($response,201);
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
        return  response()->json($response,201);
    }
    function logout(Request $request){
        auth()->user()->tokens()->delete();
        return  response()->json(['message'=>'logout succesfuly'],201) ;

    }
    function acheivements($id){
        if(User::find($id)){
                $ach= User::find($id)->acheivements->all();
            $achs =array();
        
            for($i=0;$i < count($ach); $i++)
            {
                $get=Acheivements::find($ach[$i]->acheivement_id);
                array_push($achs, $get);
            }      
            return response()->json([
                "Acheivements"=>$ach
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'error'=>'The user doesnt exists'
            ],404);
        }
    }
    function posts($id){
        if(User::find($id)){
            $posts=User::find($id)->posts;
        
            return response()->json([
                "Posts"=>$posts
            ]);
    }else{
        return response()->json([
            'status'=>404,
            'error'=>'The user doesnt exists'
        ],404);
    }
       
    }
    function tournaments($id){
        if(User::find($id)){
            $tourn= User::find($id)->tournaments->all();
            $tourns =array();
        
            for($i=0;$i < count($tourn); $i++)
            {
                $get=Tournaments::find($tourn[$i]->tournament_id);
                array_push($tourns, $get);
            }      
            return response()->json([
                "Tournaments"=>$tourns
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'error'=>'The tournament doesnt exists'
            ],404);
        }
    }
    function winningTourn($id){
        return response()->json([
            'status'=>200,
            'Tournaments'=>User::find($id)->winningTourn->all()
        ],200);
    }

    function leagues($id){
        if(User::find($id)){
            $league= User::find($id)->leagues->all();
            $leagues =array();
        
            for($i=0;$i < count($league); $i++)
            {
                $get=Leagues::find($league[$i]->league_id);
                array_push($leagues, $get);
            }      
            return response()->json([
                "Leagues"=>$leagues
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'error'=>'The tournament doesnt exists'
            ],404);
        }
    }
    function winningLeague($id){
        return response()->json([
            'status'=>200,
            'Leagues'=>User::find($id)->winningLeague->all()
        ],200);
    }
    function leagueGames($id){
        $league=(array)static::leagues($id);
        $leagues=$league['original']['Leagues'];
        $games =array();
        
        for($i=0;$i < count($leagues); $i++)
        {
            $get=$leagues[$i]->games;
            $get !='' ? array_push($games, $get): null;
        }
        return response()->json([
            'status'=>200,
            'Games'=>$games
        ],200);
    }
    function tournGames($id){
        $tourn=(array)static::tournaments($id);
        $tourns=$tourn['original']['Tournaments'];
        $games =array();
        
        for($i=0;$i < count($tourns); $i++)
        {
            $get=$tourns[$i]->games;
            $get !=''?array_push($games, $get):null;
        }
        return response()->json([
            'status'=>200,
            'Games'=>$games
        ],200);
    }
}
