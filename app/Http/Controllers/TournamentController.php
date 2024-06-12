<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Tournaments;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TournamentController extends Controller
{
    function create(Request $request  ,int $id){
        $user=User::find($id);
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5|unique:tournaments',
            'description'=>'required|min:15',
            'maxPlaces'=>'required',
            'rewards'=>'required|min:2',
            'requirements'=>'required|min:15',
            'sportType'=>'required|min:2',
            'startDate'=>'required',
            'endDate'=>'required',
            'type'=>'required|min:5'
        ]);

        if($val->fails()){
            return response()->json([
                'status'=>402,
                'errors'=>$val->messages()->toJson()
            ],402);

        }else{
            if($user){
                $tourn=new Tournaments;
                $tourn->name=$request->input('name');
                $tourn->description=$request->input('description');
                $tourn->maxPlaces=(int)$request->input('maxPlaces');
                $tourn->remainingPlaces=$tourn->maxPlaces - $tourn->takesPlaces;
                $tourn->rewards=$request->input('rewards');
                $tourn->requirements=$request->input('requirements');
                $tourn->sportType=$request->input('sportType');
                $tourn->startDate=$request->input('startDate');
                $tourn->endDate=$request->input('endDate');
                $tourn->type=$request->input('type');
                $tourn->organizer_id=$id;
                

                
                $tourn->save();
             
            
                

                return response()->json([
                    'status'=>201,
                    'message'=>'The Tournament created successfuly',
                    'tournament'=>$tourn
                ],201);

            }else{              
                return response()->json([
                    'status'=>404,
                    'errors'=>'The organizer doesnt exist'
                ],404);
            }
        }      
    }

    function show($id){
        $tourn=Tournaments::find($id);
        if(!$tourn){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Tournament doesnt exist'],404);
        }else{
            $tourn->owner=User::find($tourn->organizer_id);
            return response()->json([
                'status'=>200,
                'Tournament'=>$tourn
            ],200);
        }
    }

    function edit($id){
        $tourn=Tournaments::find($id);
        if(!$tourn){
                return response()->json([
                    'status'=>404,
                    'errors'=>'The wanted Tournament doesnt exist'
                ],404);
        }else{
            return response()->json([
                'status'=>200,
                'tournament'=>$tourn
            ],200);
        }
    }

    function update(Request $request, int $id){
        $tourn=Tournaments::find($id);
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'description'=>'required|min:15',
            'maxPlaces'=>'required',
            'rewards'=>'required|min:2',
            'requirements'=>'required|min:15',
            'sportType'=>'required|min:2',
            'startDate'=>'required|date',
            'endDate'=>'required|date',
            'type'=>'required|min:5'
        ]);
        if($val->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$val->messages()
            ],422);
        }else{

                if($tourn){
                    $tourn->name=$request->input('name');
                    $tourn->description=$request->input('description');
                    $tourn->maxPlaces=(int)$request->input('maxPlaces');
                    $tourn->remainingPlaces=$tourn->maxPlaces - $tourn->takesPlaces;
                    $tourn->rewards=$request->input('rewards');
                    $tourn->requirements=$request->input('requirements');
                    $tourn->sportType=$request->input('sportType');
                    $tourn->startDate=$request->input('startDate');
                    $tourn->endDate=$request->input('endDate');

                    $tourn->type=$request->input('type');
                    $tourn->update();

                    return response()->json([
                        'status'=>200,
                        'message'=>'The Tournament updated successfuly',
                        'Tournament'=>$tourn
                    ],200);
                }else{
                    return response()->json([
                        'status'=>404,
                        'errors'=>'The wanted Tournament doesnt exist'
                    ],404);
                }
        }
    }

    function delete($id){
        $tourn=Tournaments::find($id);
        if($tourn){
            $tourn->delete();

            return response()->json([
                'status'=>200,
                'message'=>'The Tournament deleted successfuly',
            ],200);
        }else{

            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Tournament cant be  deleted'
            ],404);
        }
    }

    function members($id){
        $member=Tournaments::find($id)->members->all();
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
    function setWinner($tournId,$userId){
        $tourn=Tournaments::find($tournId);
        $user=User::find($userId);
        if($tourn){
            if($user){
                $tourn->winner_id=(int)$userId;
                $tourn->update();
                return response()->json([
                    'status'=>200,
                    'Tournament'=>$tourn
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
                'errors'=>'The wanted Tournament doesnt exist'
            ],404);
        }
    }

    function getWinner($tournId){
        $tourn=Tournaments::find($tournId);
        if($tourn){
            if($tourn->winner_id !=Null){
                $user=User::where('id',$tourn->winner_id)->first();
                return response()->json([
                    'status'=>200,
                    'Winner'=>$user
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The Tournament doesnt has any winner yet'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Tournament doesnt exist'
            ],404);
        }
    }
    function organizer($id){
        $tourn=Tournaments::find($id);
        $user=User::find($tourn->organizer_id);
        if($tourn){
            if($user){
                return response()->json([
                    'status'=>200,
                    'Organizer'=>$user
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The Tournament doesnt has any winner yet'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Tournament doesnt exist'
            ],404);
        }
    }
    function games($id){
        $tourn=Tournaments::find($id);
        if($tourn){
            return response()->json([
                'status'=>200,
                'Games'=>$tourn->games->all()
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Tournament doesnt exist'
            ],404);
        }
    }
    function createGames($id){
        $tourn=Tournaments::find($id);
        $members=$tourn->members;
        $nubs=array();
        if($tourn){
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
                            'duration'=>$tourn->sportType==='football' ? '01:30:00' : '02:00:00',
                            'timeLeft'=>'01:30:00',
                            'startTime'=>'05:00:00',
                            'date'=>$tourn->startDate,
                            'sportType'=>$tourn->sportType,
                            'gameType'=>$tourn->type,
                            'status'=>'Not Started',
                            'competetionType'=>'Tournament',
                            'user1'=>$firstUser,
                            'user2'=>$secondtUser,
                            'tournaments'=>$tourn
                        ];
                        (new GameController)->createTournGame($data,$id);
                        array_push($nubs,$data);
                    }
                }
                
                
                return response()->json([
                    'status'=>200,
                    'message'=>"New Games Added to the Tournament.",
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
                'errors'=>'The wanted Tournament doesnt exist'
            ],404);
        }
    }
    function all_tourn(){
        $tourns=Tournaments::all();
        return response()->json([
            'tourns'=>$tourns
        ]);
    }
}