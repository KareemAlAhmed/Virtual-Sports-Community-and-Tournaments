<?php

namespace App\Http\Controllers;

use App\Models\Tournaments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentController extends Controller
{
    function create(Request $request  ,int $id){
        $user=User::find($id);
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5|unique:tournaments',
            'description'=>'required|min:15',
            'maxPlaces'=>'required',
            'rewards'=>'required|min:15',
            'requirements'=>'required|min:15',
            'sportType'=>'required|min:5',
            'startDate'=>'required|date',
            'endDate'=>'required|date',
            'duration'=>'required',
            'timeLeft'=>'required',
            'type'=>'required|min:5'
        ]);

        if($val->fails()){
            return response()->json([
                'status'=>402,
                'errors'=>$val->messages()
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
                $tourn->timeLeft=$request->input('timeLeft');
                $tourn->duration=$request->input('duration');
                $tourn->type=$request->input('type');
                $tourn->organizer_id=$id;
                $tourn->save();
            
                return response()->json([
                    'status'=>200,
                    'message'=>'The Tournament created successfuly',
                    'tournament'=>$tourn
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The organizer doesnt exist'
                ],404);
            }
        }

       
            
        
    }

    function show( $id){
        $tourn=Tournaments::find($id);
        if(!$tourn){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Tournament doesnt exist'],404);
        }else{
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
                'errors'=>'The wanted Tournament doesnt exist'],404);
        }else{
            return response()->json([
                'status'=>200,
                'Tournament'=>$tourn
            ],200);
        }
    }

    function update(Request $request, int $id){
        $tourn=Tournaments::find($id);
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'description'=>'required|min:15',
            'maxPlaces'=>'required',
            'rewards'=>'required|min:15',
            'requirements'=>'required|min:15',
            'sportType'=>'required|min:5',
            'startDate'=>'required|date',
            'endDate'=>'required|date',
            'duration'=>'required',
            'timeLeft'=>'required',
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
                    $tourn->timeLeft=$request->input('timeLeft');
                    $tourn->duration=$request->input('duration');
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
                'errors'=>'The wanted Tournament doesnt exist'
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
        return $members;
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
}