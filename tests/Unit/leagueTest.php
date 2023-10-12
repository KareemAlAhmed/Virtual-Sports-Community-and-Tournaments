<?php

namespace Tests\Unit;

use App\Models\Leagues;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class leagueTest extends TestCase
{ 
    /** @test */
    public function league_create(){
        $user=User::first();
        Auth::login($user);
        $response= $this->post('api/league/user/' . $user->id ,
        [
            
            'name'=>fake()->name(),
            'description'=>fake()->text(),
            'maxPlaces'=>'100',
            'rewards'=>fake()->text(),
            'requirements'=>fake()->text(),
            'sportType'=>fake()->sentence(6),
            'startDate'=>'2023-12-29',
            'endDate'=>'2023-12-30'    
        ]);
        $response->assertStatus(201);
    }
    /** @test  */
    public function league_show(){
        $id=Leagues::first()->id;
        $response=$this->get('api/league/' . $id);
        $response->assertStatus(200);
    }
    /** @test  */
    public function league_edit(){
        $id=Leagues::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/league/' . $id . '/edit');
        $response->assertStatus(200);
    }
    /** @test  */
    public function league_update(){
        $id=Leagues::first()->id;
        $user=User::first();
        Auth::login($user);
        
        $response=$this->put('api/league/' . $id . '/edit',[
            'name'=>fake()->name(),
            'description'=>fake()->text(),
            'maxPlaces'=>'100',
            'rewards'=>fake()->text(),
            'requirements'=>fake()->text(),
            'sportType'=>fake()->sentence(6),
            'startDate'=>'2023-12-29',
            'endDate'=>'2023-12-30'     
        ]);
        $response->assertStatus(200);
    }
   

    /** @test  */
    public function league_member(){
        $id=Leagues::first()->id;

        $response=$this->get('api/league/'. $id .'/members');
        $response->assertStatus(200);
    }
    /** @test  */
    public function league_enrollMember(){
        $id=Leagues::first()->id;
        $user=User::first();
        Auth::login($user);
        
        $response=$this->post('api/enroll/user/'. $user->id .'/league/'. $id);
        $response->assertStatus(200);
    }

    /** @test  */
    public function league_games(){
        $id=Leagues::first()->id;

        $response=$this->get('api/league/'. $id .'/games');
        $response->assertStatus(200);
    }

    /** @test  */
    public function league_createGames(){
        $id=Leagues::first()->id;

        $user=User::first();
        $user2=User::latest()->first();
        Auth::login($user);
        $response=$this->post('api/enroll/user/'. $user->id .'/league/'. $id);
        $response=$this->post('api/enroll/user/'. $user2->id .'/league/'. $id);
        
        $response=$this->post('api/league/' . $id . '/createGames');
        $response->assertStatus(200);
    }

    /** @test  */
    public function league_organizer(){
        $id=Leagues::first()->id;
        $response=$this->get('api/league/' . $id . '/organizer');
        $response->assertStatus(200);
    }
    /** @test  */
    public function league_setWinner(){
        $tournId=Leagues::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->put('api/league/'. $tournId . '/member/' . $user->id . '/winner');
        $response->assertStatus(200);
    }
    /** @test  */
    public function league_getWinner(){
        $id=Leagues::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/league/' . $id . '/winner');
        $response->assertStatus(200);
    }
  
    /** @test  */
    public function league_kickMember(){
        $id=Leagues::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->delete('api/kick/user/'. $user->id .'/league/'. $id);
        $response->assertStatus(200);
    }

     /** @test */
     public function league_delete(){
        $id=Leagues::first()->id;
        $user=User::first();
        Auth::login($user);

        $response=$this->delete('api/league/delete/'  . $id );
        $response->assertStatus(200);
    }
}
