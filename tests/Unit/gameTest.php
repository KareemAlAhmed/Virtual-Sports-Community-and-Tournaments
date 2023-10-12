<?php

namespace Tests\Unit;

use App\Models\Games;
use App\Models\Leagues;
use App\Models\Tournaments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class gameTest extends TestCase
{
       /** @test */
       public function game_tournament_create(){
        $user=User::first();
        $user2=User::latest()->first();
        Auth::login($user);
        $id=Tournaments::first()->id;

        $response= $this->post('api/game/'. $id .'/create' ,
        [
            
            'firstUserName'=>$user->name,
            'secondUserName'=>$user2->name,
            'firstUserScore'=>'1',
            'secondUserScore'=>'2',
            'duration'=>'00:30:00',
            'timeLeft'=>'00:03:00',
            'startTime'=>'15:30:00',
            'date'=>'2023-10-11',
            'sportType'=>fake()->sentence(6),
            'gameType'=>'ranked',
            'status'=>'live',
            'competetionType'=>'Tournament',
            'tournaments_id'=>Tournaments::first()->id
        
        ]);
        $response->assertStatus(201);
    }
       /** @test */
       public function game_league_create(){
        $user=User::first();
        $user2=User::latest()->first();
        Auth::login($user);
        $id=Leagues::first()->id;

        $response= $this->post('api/game/'. $id .'/create' ,
        [
            
            'firstUserName'=>$user->name,
            'secondUserName'=>$user2->name,
            'firstUserScore'=>'1',
            'secondUserScore'=>'2',
            'duration'=>'00:30:00',
            'timeLeft'=>'00:03:00',
            'startTime'=>'15:30:00',
            'date'=>'2023-10-11',
            'sportType'=>fake()->sentence(6),
            'gameType'=>'ranked',
            'status'=>'live',
            'competetionType'=>'League',
            'leagues_id'=>Leagues::first()->id
        
        ]);
        $response->assertStatus(201);
    }
    /** @test  */
    public function game_show(){
        $id=Games::first()->id;
        $response=$this->get('api/game/' . $id);
        $response->assertStatus(200);
    }
    /** @test  */
    public function game_edit(){
        $id=Games::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/game/' . $id . '/edit');
        $response->assertStatus(200);
    }
    /** @test  */
    public function game_update(){
        $id=Games::first()->id;
        $user=User::first();
        $user2=User::latest()->first();
        $id2=Tournaments::first()->id;
        Auth::login($user);
        
        $response=$this->put('api/game/' . $id . '/edit/' . $id2,[
            'firstUserName'=>$user->name,
            'secondUserName'=>$user2->name,
            'firstUserScore'=>'1',
            'secondUserScore'=>'2',
            'duration'=>'00:30:00',
            'timeLeft'=>'00:03:00',
            'startTime'=>'15:30:00',
            'date'=>'2023-10-11',
            'sportType'=>fake()->sentence(6),
            'gameType'=>'ranked',
            'status'=>'live',
            'competetionType'=>'Tournament'   
        ]);
        $response->assertStatus(200);
    }
   

    /** @test  */
    public function game_setWinner(){
        $id=Games::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->put('api/game/'. $id . '/member/' . $user->id . '/winner');
        $response->assertStatus(200);
    }
    /** @test  */
    public function game_getWinner(){
        $id=Games::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/game/' . $id . '/winner');
        $response->assertStatus(200);
    }
  
    
}
