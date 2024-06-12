<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Leagues;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LeagueController extends Controller
{
    function create(Request $request  ,int $id){
        $user=User::find($id);
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5|unique:leagues',
            'description'=>'required|min:15',
            'maxPlaces'=>'required',
            'rewards'=>'required|min:3',
            'requirements'=>'required|min:15',
            'sportType'=>'required|min:2',
            'startDate'=>'required|date',
            'endDate'=>'required|date'
        ]);

        if($val->fails()){
            return response()->json([
                'status'=>402,
                'errors'=>$val->messages()->toJson()
            ],402);
        }else{
            if($user){
                $league=new Leagues();
                $league->name=$request->input('name');
                $league->description=$request->input('description');
                $league->maxPlaces=(int)$request->input('maxPlaces');
                $league->remainingPlaces=$league->maxPlaces - $league->takesPlaces;
                $league->rewards=$request->input('rewards');
                $league->requirements=$request->input('requirements');
                $league->sportType=$request->input('sportType');
                $league->startDate=$request->input('startDate');
                $league->endDate=$request->input('endDate');
                $league->organizer_id=$id;
                $league->save();
            

                return response()->json([
                    'status'=>201,
                    'message'=>'The League Created successfuly',
                    'league'=>$league
                ],201);


            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The organizer doesnt exist'
                ],404);
            }
        }
       
    }

    function show( $id){
        $league=Leagues::find($id);
        if(!$league){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted League doesnt exist'],404);
        }else{
            $league->owner=User::find($league->organizer_id);
            return response()->json([
                'status'=>200,
                'League'=>$league
                
            ],200);
        }
    }

    function edit($id){
        $league=Leagues::find($id);
        if(!$league){

                return Redirect::back()->with('error',[response()->json([
                    'status'=>404,
                    'errors'=>'The wanted League doesnt exist'
                ],404)]);
        }else{

            return redirect('/league/create')->with('response',[response()->json([
                'status'=>201,
                'league'=>$league
            ],201)]);
        }
    }

    function update(Request $request, int $id){
        $league=Leagues::find($id);
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'description'=>'required|min:15',
            'maxPlaces'=>'required',
            'rewards'=>'required|min:3',
            'requirements'=>'required|min:15',
            'sportType'=>'required|min:5',
            'startDate'=>'required|date',
            'endDate'=>'required|date',
        ]);
        if($val->fails()){
            return Redirect::back()->with('error',[response()->json([
                'status'=>402,
                'errors'=>$val->messages()->toJson()
            ],402)]);
        }else{
                if($league){
                    $league->name=$request->input('name');
                    $league->description=$request->input('description');
                    $league->maxPlaces=(int)$request->input('maxPlaces');
                    $league->remainingPlaces=$league->maxPlaces - $league->takesPlaces;
                    $league->rewards=$request->input('rewards');
                    $league->requirements=$request->input('requirements');
                    $league->sportType=$request->input('sportType');
                    $league->startDate=$request->input('startDate');
                    $league->endDate=$request->input('endDate');
                    $league->update();
        
                    return redirect('/league/tops')->with('response',[response()->json([
                        'status'=>201,
                        'message'=>'The League created successfuly',
                        'league'=>$league
                    ],201)]);
                }else{
                    return Redirect::back()->with('error',[response()->json([
                        'status'=>404,
                        'errors'=>'The wanted League doesnt exist'
                    ],404)]);
                }
        }
    }

    function delete($id){
        $league=Leagues::find($id);
        if($league){
            $league->delete();

            return response()->json([
                'status'=>200,
                'message'=>'The League deleted successfuly',
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted League doesnt exist'
            ],404);
        }
    }

    function members($id){
        $member=Leagues::find($id)->members->all();
        $members =array();
    
        for($i=0;$i < count($member); $i++)
        {
            $get=User::find($member[$i]->user_id);
            array_push($members, $get);
        }    
        return response()->json([
            'status'=>200,
            'members'=>$members
        ],200);
    }
    function setWinner($leagueId,$userId){
        $league=Leagues::find($leagueId);
        $user=User::find($userId);
        if($league){
            if($user){
                $league->winner_id=(int)$userId;
                $league->update();
                return response()->json([
                    'status'=>200,
                    'League'=>$league
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The User doesnt exist'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted League doesnt exist'
            ],404);
        }
    }

    function getWinner($leagueId){
        $league=Leagues::find($leagueId);
        if($league){
            if($league->winner_id !=Null){
                $user=User::where('id',$league->winner_id)->first();
                return response()->json([
                    'status'=>200,
                    'Winner'=>$user
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The League doesnt has any winner yet'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted League doesnt exist'
            ],404);
        }
    }
    function organizer($id){
        $league=Leagues::find($id);
        $user=User::find($league->organizer_id);
        if($league){
            if($user){
                return response()->json([
                    'status'=>200,
                    'Organizer'=>$user
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The League doesnt has any winner yet'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted League doesnt exist'
            ],404);
        }
    }

    function games($id){
        $league=Leagues::find($id);
        if($league){
            return response()->json([
                'status'=>200,
                'Games'=>$league->games->all()
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted League doesnt exist'
            ],404);
        }
    }

    function createGames($id){
        $league=Leagues::find($id);
        $members=$league->members;
        $nubs=array();
        if($league){
            if(count($members) > 1){
                for($i=0;$i < count($members) - 1;$i++){
                    for($j=$i +1 ;$j < count($members);$j++){
                        $firstUser=User::find($members[$i]->user_id);
                        $secondtUser=User::find($members[$j]->user_id);
                        $data=[
                           'firstUserName'=>$firstUser->name,
                            'secondUserName'=>$secondtUser->name,
                            'firstUserScore'=>'Null',
                            'secondUserScore'=>'Null',
                            'duration'=>$league->sportType==='football' ? '01:30:00' : '02:00:00',
                            'timeLeft'=>'01:30:00',
                            'startTime'=>'05:00:00',
                            'date'=>$league->startDate,
                            'sportType'=>$league->sportType,
                            'gameType'=>'ranked',
                            'status'=>'Not Started',
                            'competetionType'=>'League',
                            'user1'=>$firstUser,
                            'user2'=>$secondtUser,
                            'leagues'=>$league
                        ];
                         (new GameController)->createLeagueGame($data,$id);
                        array_push($nubs,$data);
                    }
                }
               

                return response()->json([
                    'status'=>200,
                    'message'=>"The League's Games created successfuly",
                    'matches'=>$nubs
                ],200);
            }else{

                return response()->json([
                    'status'=>404,
                    'errors'=>'Not enough player to make a game'
                ],404);

            }
        }else{

            return response()->json([
                'status'=>404,
                'errors'=>'The wanted League doesnt exist'
            ],404);


        }
        
    }
    function all_leagues(){
        $leagues=Leagues::all();
        return response()->json([
            'leagues'=>$leagues
        ]);
    }
    
}
