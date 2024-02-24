<?php

namespace App\Http\Controllers;

use App\Models\Acheive;
use App\Models\Acheivements;
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
                $enroll=new enrollTournController();
                $enroll->enroll($users[$i]['id'],$num);
            }
            $tournCon=new TournamentController();
            $tournCon->createGames($num);
        }   
    }
    function checkLeague(int $num){
        $league=Leagues::find($num);
        if(count($league->games)==0){
            $users=User::all();
            for($i = 0; $i < 4;$i++){
                $enroll=new enrollLeagueController();
                $enroll->enroll($users[$i]['id'],$num);
            }
            $leagueCon=new LeagueController();
            $leagueCon->createGames($num);
        }
    }
}
