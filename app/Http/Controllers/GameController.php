<?php

namespace App\Http\Controllers;

use App\Models\enrollLeague;
use App\Models\enrollTourn;
use App\Models\Games;
use App\Models\Leagues;
use App\Models\Tournaments;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    function create(Request $request ,int $id){
        $user1=User::where('name',$request->input('firstUserName'))->first();
        $user2=User::where('name',$request->input('secondUserName'))->first();
        $attr=Validator::make($request->all(),[
            'firstUserName'=>'min:3|required',
            'secondUserName'=>'min:3|required',
            'firstUserScore'=>'required',
            'secondUserScore'=>'required',
            'duration'=>'required',
            'timeLeft'=>'required',
            'startTime'=>'required',
            'date'=>'required|date',
            'sportType'=>'required|min:5',
            'gameType'=>'required|min:5',
            'status'=>'required|min:3',
            'competetionType'=>'min:5|required'
        ]);
        if($attr->fails()){
            return response()->json([
                'status'=>402,
                'error'=>$attr->messages()
            ],402);
        }else{
            if($request->input('competetionType')=='Tournament'){
                if(Tournaments::find($id)){
                    if($user1 && $user2){
                        $game=new Games;
                        $game->firstUserName=$request->input('firstUserName');
                        $game->secondUserName=$request->input('secondUserName');
                        $game->firstUserScore=(int)$request->input('firstUserScore');
                        $game->secondUserScore=(int)$request->input('secondUserScore');
                        $game->duration=$request->input('duration');
                        $game->timeLeft=$request->input('timeLeft');
                        $game->startTime=$request->input('startTime');
                        $game->date=$request->input('date');
                        $game->sportType=$request->input('sportType');
                        $game->gameType=$request->input('gameType');
                        $game->competetionType=$request->input('competetionType');
                        $game->status=$request->input('status');
                        $game->tournaments_id=$id;
                        $game->user_id=$user1->id;
                        $game->user2_id=$user2->id;
                        if($request->input('status')=='finished'){
                            if($game->firstUserScore > $game->secondUserScore){
                                $game->winner_id=$user1->id;
                            }else{
                                $game->winner_id=$user2->id;
                            }
                        }
                        $game->save();
                        return response()->json([
                            'status'=>201,
                            'Game'=>$game
                        ],201);
                    }else{
                        return response()->json([
                            'status'=>404,
                            'error'=> $user1 ? 'The user ' .$request->input('secondUserName') . ' doesnt exist' :'The user ' .$request->input('firstUserName') . ' doesnt exist'
                        ],404);
                    }
                  
                }else{
                    return response()->json([
                        'status'=>404,
                        'error'=>'The Tournament wanted doesnt exist'
                    ],404);
                }
                
            }else{
                if($request->input('competetionType')=='League'){
                    if(Leagues::find($id)){
                        if($user1 && $user2){
                            $game=new Games;
                            $game->firstUserName=$request->input('firstUserName');
                            $game->secondUserName=$request->input('secondUserName');
                            $game->firstUserScore=(int)$request->input('firstUserScore');
                            $game->secondUserScore=(int)$request->input('secondUserScore');
                            $game->duration=$request->input('duration');
                            $game->timeLeft=$request->input('timeLeft');
                            $game->startTime=$request->input('startTime');
                            $game->date=$request->input('date');
                            $game->sportType=$request->input('sportType');
                            $game->gameType=$request->input('gameType');
                            $game->competetionType=$request->input('competetionType');
                            $game->status=$request->input('status');
                            $game->leagues_id=$id;
                            $game->user_id=$user1->id;
                            $game->user2_id=$user2->id;
                            if($request->input('status')=='finished'){
                                if($game->firstUserScore > $game->secondUserScore){
                                    $game->winner_id=$user1->id;
                                }else{
                                    $game->winner_id=$user2->id;
                                }
                            }
                            $game->save();
                            return response()->json([
                                'status'=>201,
                                'Game'=>$game
                            ],201);
                        }else{
                            return response()->json([
                                'status'=>404,
                                'error'=> $user1 ? 'The user ' .$request->input('secondUserName') . ' doesnt exist' :'The user ' .$request->input('firstUserName') . ' doesnt exist'
                            ],404);
                        }
                    }return response()->json([
                        'status'=>404,
                        'error'=>'The League wanted doesnt exist'
                    ],404);
                }
                return response()->json([
                    'status'=>404,
                    'error'=>'The Competetion type wanted doesnt exist'
                ],404);
            }
        }
    }

    function show($id){
            $game=Games::find($id);
            if($game){
                return response()->json([
                    'status'=>200,
                    'Game'=>$game
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'error'=>'The wanted Game doesnt exist'
                ],404); 
            }
    }
    function edit($id){
            $game=Games::find($id);
            if($game){
                return response()->json([
                    'status'=>200,
                    'Game'=>$game
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'error'=>'The wanted Game doesnt exist'
                ],404); 
            }
    }
    function update(Request $request,$gameId,$tournLeagueId){
        $user1=User::where('name',$request->input('firstUserName'))->first();
        $user2=User::where('name',$request->input('secondUserName'))->first();
        $games=Games::find($gameId);
        $attr=Validator::make($request->all(),[
            'firstUserName'=>'min:3|required',
            'secondUserName'=>'min:3|required',
            'firstUserScore'=>'required',
            'secondUserScore'=>'required',
            'duration'=>'required',
            'timeLeft'=>'required',
            'startTime'=>'required',
            'date'=>'required|date',
            'sportType'=>'required|min:5',
            'gameType'=>'required|min:5',
            'status'=>'required|min:3',
            'competetionType'=>'min:5|required'
        ]);
        if($attr->fails()){
            return response()->json([
                'status'=>402,
                'error'=>$attr->messages()
            ],402);
        }else{
            if($request->input('competetionType')=='Tournament'){
                if(Tournaments::find($tournLeagueId)){
                    if($user1 && $user2){
                        if($games){
                            $games->firstUserName=$request->input('firstUserName');
                            $games->secondUserName=$request->input('secondUserName');
                            $games->firstUserScore=(int)$request->input('firstUserScore');
                            $games->secondUserScore=(int)$request->input('secondUserScore');
                            $games->duration=$request->input('duration');
                            $games->timeLeft=$request->input('timeLeft');
                            $games->startTime=$request->input('startTime');
                            $games->date=$request->input('date');
                            $games->sportType=$request->input('sportType');
                            $games->gameType=$request->input('gameType');
                            $games->competetionType=$request->input('competetionType');
                            $games->status=$request->input('status');
                            $games->tournaments_id=(int)$tournLeagueId;
                            $games->leagues_id !='' ? $games->leagues_id=null :null;
                            $games->user_id=$user1->id;
                            $games->user2_id=$user2->id;
                            if($request->input('status')=='finished'){
                                if($games->firstUserScore > $games->secondUserScore){
                                    $games->winner_id=$user1->id;
                                }else{
                                    $games->winner_id=$user2->id;
                                }
                            }
                            $games->update();
                            return response()->json([
                                'status'=>200,
                                'Game'=>$games
                            ],200);
                        }else{
                            return response()->json([
                            'status'=>404,
                            'error'=>'The Game doesnt exist'
                        ],404); 
                    }
                    }else{
                        return response()->json([
                            'status'=>404,
                            'error'=> $user1 ? 'The user ' .$request->input('secondUserName') . ' doesnt exist' :'The user ' .$request->input('firstUserName') . ' doesnt exist'
                        ],404);
                    }
                  
                }else{
                    return response()->json([
                        'status'=>404,
                        'error'=>'The Tournament wanted doesnt exist'
                    ],404);
                }
                
            }else{
                if($request->input('competetionType')=='League'){
                    if(Leagues::find($tournLeagueId)){
                        if($user1 && $user2){
                            if($games){
                                $games->firstUserName=$request->input('firstUserName');
                                $games->secondUserName=$request->input('secondUserName');
                                $games->firstUserScore=(int)$request->input('firstUserScore');
                                $games->secondUserScore=(int)$request->input('secondUserScore');
                                $games->duration=$request->input('duration');
                                $games->timeLeft=$request->input('timeLeft');
                                $games->startTime=$request->input('startTime');
                                $games->date=$request->input('date');
                                $games->sportType=$request->input('sportType');
                                $games->gameType=$request->input('gameType');
                                $games->competetionType=$request->input('competetionType');
                                $games->status=$request->input('status');
                                $games->leagues_id=(int)$tournLeagueId;
                                 $games->tournaments_id !='' ? $games->tournaments_id=null :'success';
                                 $games->user_id=$user1->id;
                                 $games->user2_id=$user2->id;
                                if($request->input('status')=='finished'){
                                    if($games->firstUserScore > $games->secondUserScore){
                                        $games->winner_id=$user1->id;
                                    }else{
                                        $games->winner_id=$user2->id;
                                    }
                                }
                                $games->update();
                                return response()->json([
                                    'status'=>200,
                                    'Game'=>$games
                                ],200);
                            }else{
                                return response()->json([
                                    'status'=>404,
                                    'error'=>'The Game doesnt exist'
                                ],404); 
                            }
                        }else{
                            return response()->json([
                                'status'=>404,
                                'error'=> $user1 ? 'The user ' .$request->input('secondUserName') . ' doesnt exist' :'The user ' .$request->input('firstUserName') . ' doesnt exist'
                            ],404);
                        }
                    }return response()->json([
                        'status'=>404,
                        'error'=>'The League wanted doesnt exist'
                    ],404);
                }
                return response()->json([
                    'status'=>404,
                    'error'=>'The Competetion type wanted doesnt exist'
                ],404);
            }
        }

    }

    function delete($id){
        $game=Games::find($id);
        if($game){
            $game->delete();
            return response()->json([
                'status'=>200,
         
                'message'=>'The Game deleted successfuly'
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'error'=>'The Wanted Game  doesnt exist'
            ],404);
        }
    }

    function setWinner($gameId,$userId){
        $game=Games::find($gameId);
        $user=User::find($userId);
        if($game){
            if($user){
                $game->winner_id=(int)$userId;
                $game->update();
                return response()->json([
                    'status'=>200,
                    'Tournament'=>$game
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
                'errors'=>'The wanted Game doesnt exist'
            ],404);
        }
    }

    function getWinner($gameId){
        $game=Games::find($gameId);
        if($game){
            if($game->winner_id !=Null){
                $user=User::where('id',$game->winner_id)->first();
                return response()->json([
                    'status'=>200,
                    'Winner'=>$user
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'errors'=>'The Game doesnt has any winner yet'
                ],404);
            }
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Game doesnt exist'
            ],404);
        }
    }

    function createTournGame(array $request ,int $id){
        // return ['GAME'=>$request['firstUserName']];

        $user1=User::where('name',$request['firstUserName'])->first();
        $user2=User::where('name',$request['secondUserName'])->first();
        $result=Games::where('firstUserName',$user1->name)->where('secondUserName',$user2->name)->where('tournaments_id',$id)->first();
        if($result){
            return false;
        }
        $attr=Validator::make($request,[
            'firstUserName'=>'min:3|required',
            'secondUserName'=>'min:3|required',
            'firstUserScore'=>'required',
            'secondUserScore'=>'required',
            'duration'=>'required',
            'timeLeft'=>'required',
            'startTime'=>'required',
            'date'=>'required|date',
            'sportType'=>'required|min:2',
            'gameType'=>'required|min:5',
            'status'=>'required|min:5',
            'competetionType'=>'min:5|required'
        ]);
        if($attr->fails()){

            return response()->json([
                'status'=>402,
                'error'=>$attr->messages()
            ],402);
        }else{
            if($request['competetionType'] =='Tournament'){
                if(Tournaments::find($id)){
                    if($user1 && $user2){
                        $game=new Games;
                        $game->firstUserName=$request['firstUserName'];
                        $game->secondUserName=$request['secondUserName'];
                        $game->firstUserScore=Null;
                        $game->secondUserScore=Null;
                        $game->duration=$request['duration'];
                        $game->timeLeft=$request['timeLeft'];
                        $game->startTime=$request['startTime'];
                        $game->date=$request['date'];
                        $game->sportType=$request['sportType'];
                        $game->gameType=$request['gameType'];
                        $game->competetionType=$request['competetionType'];
                        $game->status=$request['status'];
                        $game->tournaments_id=$id;
                        $game->user_id=$user1->id;
                        $game->user2_id=$user2->id;
                        $game->save();
                        return response()->json([
                            'status'=>201,
                            'Game'=>$game
                        ],201);
                    }else{
                        return response()->json([
                            'status'=>404,
                            'error'=> $user1 ? 'The user ' .$request['secondUserName'] . ' doesnt exist' :'The user ' .$request['firstUserName'] . ' doesnt exist'
                        ],404);
                    }
                  
                }else{
                    return response()->json([
                        'status'=>404,
                        'error'=>'The Tournament wanted doesnt exist'
                    ],404);
                }
                
            }else{
                
                return response()->json([
                    'status'=>404,
                    'error'=>'The Competetion type wanted doesnt exist'
                ],404);
            }
        }
    }

    function createLeagueGame(array $request ,int $id){
        $user1=User::where('name',$request['firstUserName'])->first();
        $user2=User::where('name',$request['secondUserName'])->first();
        $result=Games::where('firstUserName',$user1->name)->where('secondUserName',$user2->name)->where('leagues_id',$id)->first();
        if($result){
            return null;
        }
        $attr=Validator::make($request,[
            'firstUserName'=>'min:3|required',
            'secondUserName'=>'min:3|required',
            'firstUserScore'=>'required',
            'secondUserScore'=>'required',
            'duration'=>'required',
            'timeLeft'=>'required',
            'startTime'=>'required',
            'date'=>'required|date',
            'sportType'=>'required|min:2',
            'gameType'=>'required|min:5',
            'status'=>'required|min:5',
            'competetionType'=>'min:5|required'
        ]);
        if($attr->fails()){
            return response()->json([
                'status'=>402,
                'error'=>$attr->messages()
            ],402);
        }else{
            if($request['competetionType'] =='League'){
                if(Leagues::find($id)){
                    if($user1 && $user2){
                        $game=new Games;
                        $game->firstUserName=$request['firstUserName'];
                        $game->secondUserName=$request['secondUserName'];
                        $game->firstUserScore=Null;
                        $game->secondUserScore=Null;
                        $game->duration=$request['duration'];
                        $game->timeLeft=$request['timeLeft'];
                        $game->startTime=$request['startTime'];
                        $game->date=$request['date'];
                        $game->sportType=$request['sportType'];
                        $game->gameType=$request['gameType'];
                        $game->competetionType=$request['competetionType'];
                        $game->status=$request['status'];
                        $game->leagues_id=$id;
                        $game->user_id=$user1->id;
                        $game->user2_id=$user2->id;
                        $game->save();
                        return response()->json([
                            'status'=>201,
                            'Game'=>$game
                        ],201);
                    }else{
                        return response()->json([
                            'status'=>404,
                            'error'=> $user1 ? 'The user ' .$request['secondUserName'] . ' doesnt exist' :'The user ' .$request['firstUserName'] . ' doesnt exist'
                        ],404);
                    }
                  
                }else{
                    return response()->json([
                        'status'=>404,
                        'error'=>'The League wanted doesnt exist'
                    ],404);
                }
                
            }else{
                
                return response()->json([
                    'status'=>404,
                    'error'=>'The Competetion type wanted doesnt exist'
                ],404);
            }
        }
    }
    function all(){
        $games=Games::all();
        return response()->json([
            'games'=>$games
        ]);
    }
    function user_games($id){
        $userGamesP1=User::find($id)->gamesAsP1;
        $userGamesP2=User::find($id)->gamesAsP2;
        return [...$userGamesP1,...$userGamesP2];
    }
    function simulate_game($id){
        $game=Games::find($id);
        if(isset($game)){
            if($game->status =="Not Started"){
                $firstScore=rand(0,10);
                $secondtScore=rand(0,10);
                while($firstScore == $secondtScore){
                    $firstScore=rand(0,10);
                    $secondtScore=rand(0,10);
                }
                if($firstScore >  $secondtScore){
                    $game->firstUserScore=$firstScore;
                    $game->secondUserScore=$secondtScore;
                    $dt = new DateTime();
                    $dt->setTime(0, 0);
                    $game->timeLeft=$dt;
                    $game->status="finished";
                    $game->winner_id=$game->user_id;
                    if($game->tournaments_id != Null){
                        $enroll=enrollTourn::where("tournament_id",$game->tournaments_id)->where("user_id",$game->user_id)->first();
                        $enroll2=enrollTourn::where("tournament_id",$game->tournaments_id)->where("user_id",$game->user2_id)->first();
                        $enroll->scores +=3;
                        $enroll->OwnScore_OppScore += $firstScore - $secondtScore;
                        $enroll2->OwnScore_OppScore += $secondtScore - $firstScore;
                        $enroll->update();
                        $enroll2->update();
                    }else{
                        $enroll=enrollLeague::where("league_id",$game->leagues_id)->where("user_id",$game->user_id)->first();
                        $enroll2=enrollLeague::where("league_id",$game->leagues_id)->where("user_id",$game->user2_id)->first();
                        $enroll->scores +=3;
                        $enroll->OwnScore_OppScore += $firstScore - $secondtScore;
                        $enroll2->OwnScore_OppScore += $secondtScore - $firstScore;
                        $enroll->update();
                        $enroll2->update();
                    }
                    $game->update();


                }else{
                    $game->firstUserScore=$firstScore;
                    $game->secondUserScore=$secondtScore;
                    $dt = new DateTime();
                    $dt->setTime(0, 0);
                    $game->timeLeft=$dt;
                    $game->status="finished";
                    $game->winner_id=$game->user2_id;
                    if($game->tournaments_id != Null){
                        $enroll=enrollTourn::where("tournament_id",$game->tournaments_id)->where("user_id",$game->user2_id)->first();
                        $enroll2=enrollTourn::where("tournament_id",$game->tournaments_id)->where("user_id",$game->user_id)->first();
                        $enroll2->OwnScore_OppScore += $firstScore - $secondtScore;
                        $enroll->OwnScore_OppScore += $secondtScore - $firstScore;
                        $enroll->scores +=3;
                        $enroll->update();
                        $enroll2->update();
                    }else{
                        $enroll=enrollLeague::where("league_id",$game->leagues_id)->where("user_id",$game->user2_id)->first();
                        $enroll2=enrollLeague::where("league_id",$game->leagues_id)->where("user_id",$game->user_id)->first();
                        $enroll2->OwnScore_OppScore += $firstScore - $secondtScore;
                        $enroll->OwnScore_OppScore += $secondtScore - $firstScore;
                        $enroll->scores +=3;
                        $enroll->update();
                        $enroll2->update();
                    }
                    $game->update();
                }


            }else{
                return null;
            }

        }else{
            return response()->json([
                "status"=>404,
                "error"=>"The Game Doesnt Exist!"
            ]);
        }
    }
    function simulate_knockout_game($id){
        $game=Games::find($id);
        if(isset($game)){
            if($game->status =="Not Started"){
                $firstScore=rand(0,10);
                $secondtScore=rand(0,10);
                while($firstScore == $secondtScore){
                    $firstScore=rand(0,10);
                    $secondtScore=rand(0,10);
                }
                if($firstScore >  $secondtScore){
                    $game->firstUserScore=$firstScore;
                    $game->secondUserScore=$secondtScore;
                    $dt = new DateTime();
                    $dt->setTime(0, 0);
                    $game->timeLeft=$dt;
                    $game->status="finished";
                    $game->winner_id=$game->user_id;

                    $game->update();
                    return $game->user_id;

                }else{
                    $game->firstUserScore=$firstScore;
                    $game->secondUserScore=$secondtScore;
                    $dt = new DateTime();
                    $dt->setTime(0, 0);
                    $game->timeLeft=$dt;
                    $game->status="finished";
                    $game->winner_id=$game->user2_id;

                    $game->update();
                    return $game->user2_id;
                }


            }else{
                return null;
            }

        }else{
            return response()->json([
                "status"=>404,
                "error"=>"The Game Doesnt Exist!"
            ]);
        }
    }

    function get_bette_stat($id,$userId){
        $game=Games::find($id);
        if($userId == $game->user_id){
            return $game->firstUserScore - $game->secondUserScore;
        }else{
            return $game->secondUserScore - $game->firstUserScore;
        }
    }
}
