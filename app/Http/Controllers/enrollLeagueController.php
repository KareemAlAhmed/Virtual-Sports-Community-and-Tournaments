<?php

namespace App\Http\Controllers;

use App\Models\enrollLeague;
use App\Models\Leagues;
use App\Models\User;
use Illuminate\Http\Request;

class enrollLeagueController extends Controller
{
    function enroll($userId,$leagueId){
        $user=User::find($userId);
        $league=Leagues::find($leagueId);
        if($user){
            if($league){
                $enrollement= new enrollLeague;
                $enrollement->user_id=$userId;
                $enrollement->league_id=$leagueId;
                $enrollement->save();
                $league->takesPlaces +=1;
                $league->remainingPlaces -=1;
                $league->update();
                return response()->json([
                    'status'=>200,
                    'Enrollement'=>$enrollement
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'error'=>'The League doesnt exist'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'error'=>'The User doesnt exist'
            ],404);
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
                return response()->json([
                    'status'=>200,
                    'message'=>'The user has been kicked out of the league'
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'error'=>'The League doesnt exist'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'error'=>'The User doesnt exist'
            ],404);
        }
    }
}
