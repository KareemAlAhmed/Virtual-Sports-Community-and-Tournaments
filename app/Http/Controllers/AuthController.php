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
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'min:3|unique:users|required',
            'email'=>'min:10|unique:users|required',
            'password'=>'min:5|required',
            'bio'=>"min:10 |required",
            'image_url'=>"min:5"
        ]);
        $user=new User;
        $user->name=$request->input("name");
        $user->password=bcrypt($request->input("password"));
        $user->bio=$request->input("bio");
        $user->email=$request->input("email");
        if($request->hasFile('image_url')){
            $user->image_url=$request->image_url->getClientOriginalName();
            $request->image_url->storeAs('public/UserProfilePic',$user->image_url);
        }
        $user->save();
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
        Auth::login($user);
        return redirect('/')->with('response',[response()->json($response,201)]);
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
       return redirect('/')->with('response',[response()->json($response,200)]);
    }
    function logout(Request $request){
        auth()->guard('web')->logout();
        auth()->user()->tokens()->delete();

        return redirect('/')->with('response',[response()->json(['message'=>'logout succesfuly'],200)]);

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
                "Acheivements"=>$ach,
                
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
    function edit(Request $request,int $id){
        $user=User::find($id);
        $val=Validator::make($request->all(),[
            'name'=>'min:3|unique:users',
            'bio'=>"min:20 |required"
            ]);
        if($val->fails()){
            return response()->json([
                'status'=>402,
                'errors'=>$val->messages()
            ],402);
        }else{
            if($user){
                $user->name=$request->input('name');
                $user->bio=$request->input('bio');
                if($request->hasFile('image_url')){
                    $user->image_url=$request->image_url->getClientOriginalName();
                    $request->image_url->storeAs('public/UserProfilePic',$user->image_url);
                }
                $user->update();

                return response()->json([
                    'status'=>200,
                    'message'=>'Your information updated successfuly',
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The User doesnt exist'
                ],404);
            }
        }


        
        
    }
}
