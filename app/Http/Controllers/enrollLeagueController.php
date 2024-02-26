<?php

namespace App\Http\Controllers;

use App\Models\enrollLeague;
use App\Models\Games;
use App\Models\Leagues;
use App\Models\User;
use Illuminate\Http\Request;

class enrollLeagueController extends Controller
{
    function enroll($userId,$leagueId){
        $user=User::find($userId);
        $league=Leagues::find($leagueId);

        if(enrollLeague::where("user_id",$userId)->where("league_id",$leagueId)->exists()){
            return redirect()->back()->with('error',[response()->json([
                'status'=>404,
                'errors'=>'You Already Joined The League'
            ],400)]);
        }


        if($user){
            if($league){

                if($league->remainingPlaces > 0){
                    $enrollement= new enrollLeague;
                    $enrollement->user_id=$userId;
                    $enrollement->league_id=$leagueId;
                    $enrollement->save();
                    $league->takesPlaces +=1;
                    $league->remainingPlaces -=1;
                    $league->update();

                    $leagues=new LeagueController();
                    $leagues->createGames($leagueId);

                    return redirect()->back()->with('response',[response()->json([
                        'status'=>200,
                        'message'=>'You successefuly Join '. $league->name . ' league',
                        'Enrollement'=>$enrollement
                    ],200)]);

                }else{
                    return redirect()->back()->with('error',[response()->json([
                        'status'=>404,
                        'errors'=>'No Remaining Places'
                    ],404)]); 
                }



            }else{
                return redirect()->back()->with('error',[response()->json([
                    'status'=>404,
                    'errors'=>'The League doesnt exist'
                ],404)]);
            }
        }else{
            return redirect()->back()->with('error',[response()->json([
                'status'=>404,
                'errors'=>'The User doesnt exist'
            ],404)]);
        }
    }

    function kick($userId,$leagueId){
        $user=User::find($userId);
        $league=Leagues::find($leagueId);
        if($user){
            if($league){
                $enrollement=enrollleague::where("league_id",$leagueId)->where('user_id',$userId)->first();
                $enrollement->delete();
                $league->takesPlaces -=1;
                $league->remainingPlaces +=1;
                $league->update();

                $playerGames=Games::where('firstUserName',$user->name)->orWhere('secondUserName',$user->name)->get();
                for($i = 0; $i< count($playerGames);$i++){
                    Games::find($playerGames[$i]['id'])->delete();
                }



                return redirect()->back()->with('response',[response()->json([
                    'status'=>200,
                    'message'=>'The user has been kicked out of the league'
                ],200)]);
            }else{
                return redirect()->back()->with('error',[response()->json([
                    'status'=>404,
                    'errors'=>'The League doesnt exist'
                ],404)]);
            }
        }else{
            return redirect()->back()->with('error',[response()->json([
                'status'=>404,
                'error'=>'The User doesnt exist'
            ],404)]);
        }
    }
}
