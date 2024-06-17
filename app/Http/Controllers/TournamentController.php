<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Tournaments;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if(($request['maxPlaces'] % 4) != 0 && $request['type'] == "knockout"){
            return response()->json([
                'status'=>403,
                'errors'=>"Max Places Number Should Be Multiple Of 4"
            ],402);
        }
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
            $memNb=count($members);
            if($tourn->type != "knockout"){
                if($memNb > 1){
                    for($i=0;$i < $memNb - 1;$i++){
                        for($j=$i +1 ;$j < $memNb;$j++){
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
                        'errors'=>'The Tournament Should Be Full To Start.'
                    ],404);
                }
            }else{
                if($memNb == $tourn->maxPlaces){

                    $firstPhaseNbMatches=$memNb/2;
                        $j=0;
                        for($i=0;$i < $firstPhaseNbMatches;$i++){
                            $firstUser=User::find($members[$j]->user_id);
                            $secondtUser=User::find($members[$j+1]->user_id);
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
                            $j+=2;
                            array_push($nubs,$data);
                        }
                    
                    
                    
                    return response()->json([
                        'status'=>200,
                        'message'=>"New Games Added to the Tournament.",
                        'matches'=>$nubs
                    ],200);
    
    
                }else{
                    return response()->json([
                        'status'=>404,
                        'errors'=>'The Tournament Should Be Full To Start.'
                    ],404);
                }
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
    function simulate_games($id){
        $tourn=Tournaments::find($id);
        $gameC= new GameController();   
        $ids=[];
        if($tourn->type !="knockout"){
            $games=$tourn->games;
            
            foreach($games as $game){
                $gameC->simulate_game($game->id);
            }
    
            $db_tourn = DB::table('enroll_tourns');
            $max_scores = $db_tourn->max('scores');

            $playerWithMaxScores = $db_tourn->where("scores",$max_scores)->get();
            if(count($playerWithMaxScores) > 1){
                $max_ownop=$playerWithMaxScores[0]->OwnScore_OppScore;
                $userOfMx=$playerWithMaxScores[0]->user_id;
                for($i=1;$i<count($playerWithMaxScores);$i++){
                    if($playerWithMaxScores[$i]->OwnScore_OppScore > $max_ownop){
                        $max_ownop=$playerWithMaxScores[$i]->OwnScore_OppScore;
                        $userOfMx=$playerWithMaxScores[$i]->user_id;
                    }
                }
            }
            $tourn->winner_id=$userOfMx;
            $tourn->update();
            return response()->json([
                "status"=>200,
                "message"=>"The Games Simulated Successfuly"
            ]);
        }else{
            
            
            do{
                $ids=[];
                $games=Games::where("tournaments_id",$tourn->id)->where("status","Not Started")->get();
                $nbGames=count($games); //4
                foreach($games as $game){
                    $winnerId=$gameC->simulate_knockout_game($game->id);
                    array_push($ids,$winnerId);
                }
                $nbGames = $nbGames/2;
                if($nbGames>=1){
                        $j=0;
                        for($i=0;$i < $nbGames;$i++){
                            $firstUser=User::find($ids[$j]);
                            $secondtUser=User::find($ids[$j+1]);
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
                            $j+=2;
                        }
                }
            } while($nbGames>=1);
            
            
        
            $tourn->winner_id=$ids[0];


            $tourn->update();
            return response()->json([
                "status"=>200,
                "message"=>"The Games Simulated Successfuly"
            ]);
        }
    }
}