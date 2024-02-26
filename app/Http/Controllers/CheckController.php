<?php

namespace App\Http\Controllers;

use App\Models\Acheive;
use App\Models\Acheivements;
use App\Models\enrollLeague;
use App\Models\enrollTourn;
use App\Models\Leagues;
use App\Models\Posts;
use App\Models\Tournaments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;

class CheckController extends Controller
{
    function checkInfo(){

        $userExists = User::where("name", "Della Bosco Jr.")->exists();
        if(!$userExists){
            User::factory(1)->create(['id'=>1,'image_url'=>'images.jpeg','name'=>'Della Bosco Jr.']);
            User::factory(1)->create(['id'=>2,'image_url'=>'images.jpeg']);
            User::factory(1)->create(['id'=>3,'image_url'=>'images.jpeg']);
            User::factory(1)->create(['id'=>4,'image_url'=>'images.jpeg']);
            Posts::factory(5)->create(['user_id'=>1,'image_url'=>'images.jpeg']);
            Posts::factory(5)->create(['user_id'=>2,'image_url'=>'images.jpeg']);
            Posts::factory(5)->create(['user_id'=>3,'image_url'=>'images.jpeg']);
            Posts::factory(5)->create(['user_id'=>4,'image_url'=>'images.jpeg']);
            $this->autoCreate();
        }
        $postExist=Posts::where('content', 'LESSER YEARS THIRD IN YOU’RE RULE')->exists();
        if(!$postExist){
            Posts::factory()->create(['user_id'=>1,'id'=>'31','content'=>'LESSER YEARS THIRD IN YOU’RE RULE','image_url'=>'post-41.jpg']);
            Posts::factory()->create(['user_id'=>1,'id'=>'35','content'=>'WE FOUND A WITCH! MAY WE BURN HER?','image_url'=>'post-31-300x169.jpg']);
            Posts::factory()->create(['user_id'=>1,'id'=>'36','content'=>'CREEPETH YOU’RE A BEHOLD HEAVEN','image_url'=>'post-51-300x188.jpg']);
        }
        if(!User::where('name', 'karim')->exists()){
            $user=new User;
            $user->name='karim';
            $user->password=bcrypt("81258136");
            $user->bio="i am the admin";
            $user->email="karimahmad@gmail.com";     
            $user->image_url="images.jpeg";     
            $user->save();
        }
       
    }
    function checkTourn(int $num){
        $tourn=Tournaments::find($num);

        if(count($tourn->games)==0){
            $users=User::all();
            for($i = 0; $i < 4;$i++){
                $this->enroll($users[$i]['id'],$num,"tourn");
            }
            $this->createGames($num,"tourn");
        }   
    }
    function checkLeague(int $num){
        $league=Leagues::find($num);
        if(count($league->games)==0){
            $users=User::all();
            for($i = 0; $i < 4;$i++){           
                $this->enroll($users[$i]['id'],$num,"league");
            }
            $this->createGames($num,"league");
        }
    }
    function autoCreate(){
        $allTourn=Tournaments::all();
        if(count($allTourn)==0){
            $tourn=new Tournaments();
            $tourn->name="CS:GO2 2024";
            $tourn->description="Attention all Counter-Strike aficionados! Prepare yourselves for the ultimate test of skill and strategy in the CS:GO Championship Series 2. It's time to showcase your prowess in the world's most iconic tactical shooter and compete against the best teams in electrifying showdowns of precision, teamwork, and tactical finesse.";
            $tourn->maxPlaces=20;
            $tourn->remainingPlaces=20;
            $tourn->rewards="2000";
            $tourn->requirements="1)+18 years old / 2)Rank elite";
            $tourn->sportType="CS";
            $tourn->startDate="2024-02-13";
            $tourn->endDate="2024-02-14";
            $tourn->timeLeft="20:00";
            $tourn->duration="20:00";
            $tourn->type="Ranked";
            $tourn->organizer_id=1;
            $tourn->save();

            $this->checkTourn($tourn->id);
            
        }

        $allLeague=Leagues::all();
        if(count($allLeague)==0){
            $league=new Leagues();
            $league->name="CS:GO2 2024";
            $league->description="Attention all Counter-Strike aficionados! Prepare yourselves for the ultimate test of skill and strategy in the CS:GO Championship Series 2. It's time to showcase your prowess in the world's most iconic tactical shooter and compete against the best teams in electrifying showdowns of precision, teamwork, and tactical finesse.";
            $league->maxPlaces=20;
            $league->remainingPlaces=20;
            $league->rewards="5000";
            $league->requirements="1)+18 years old / 2)Rank elite";
            $league->sportType="CS";
            $league->startDate="2024-02-13";
            $league->endDate="2024-02-20";
            $league->organizer_id=1;
            $league->save();

            $this->checkLeague($league->id);
        }

    }
    function createGames($id,string $type){
        if($type=="tourn"){
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
                                'competetionType'=>'Tournament'
                            ];
                            (new GameController)->createTournGame($data,$id);
                            array_push($nubs,$data);
                        }
                    }
                    return true;


                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
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
                                'competetionType'=>'League'
                            ];
                            (new GameController)->createLeagueGame($data,$id);
                            array_push($nubs,$data);
                        }
                    }
                    

                    return true;
                }else{

                    return false;

                }
            }else{
                return false;
            }
        }
    }
    function enroll($userId,$id,string $type){
        if($type == "tourn"){
            $user=User::find($userId);
            $tourn=Tournaments::find($id);
            if(enrollTourn::where("user_id",$userId)->where("tournament_id",$id)->exists()){
                return false;
            }
            if($user){
                if($tourn){
                    if($tourn->remainingPlaces > 0){
                        $enrollement= new enrollTourn;
                        $enrollement->user_id=$userId;
                        $enrollement->tournament_id=$id;
                        $enrollement->save();
                        
                        $tourn->takesPlaces +=1;
                        $tourn->remainingPlaces -=1;
                        $tourn->update();

                        return true;
                    }else{
                        return false;
                    }


                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            $user=User::find($userId);
            $league=Leagues::find($id);

            if(enrollLeague::where("user_id",$userId)->where("league_id",$id)->exists()){
                return false;
            }
            if($user){
                if($league){

                    if($league->remainingPlaces > 0){
                        $enrollement= new enrollLeague;
                        $enrollement->user_id=$userId;
                        $enrollement->league_id=$id;
                        $enrollement->save();
                        $league->takesPlaces +=1;
                        $league->remainingPlaces -=1;
                        $league->update();

                        return true;

                    }else{
                        return false; 
                    }

                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
}
