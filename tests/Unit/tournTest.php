<?php

namespace Tests\Unit;

use App\Models\Tournaments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class tournTest extends TestCase
{
         /** @test */
     public function tourn_create(){
        $user=User::first();
        Auth::login($user);
        $response= $this->post('api/tournament/user/' . $user->id ,
        [
            
            'name'=>fake()->name(),
            'description'=>fake()->text(),
            'maxPlaces'=>'100',
            'rewards'=>fake()->text(),
            'requirements'=>fake()->text(),
            'sportType'=>fake()->sentence(6),
            'startDate'=>'2023-12-29',
            'endDate'=>'2023-12-30',
            'duration'=>'12:00:00',
            'timeLeft'=>'12:00:00',
            'type'=>fake()->sentence(6)
        
        ]);
        $response->assertStatus(201);
    }
    /** @test  */
    public function tourn_show(){
        $id=Tournaments::first()->id;
        $response=$this->get('api/tournament/' . $id);
        $response->assertStatus(200);
    }
    /** @test  */
    public function tourn_edit(){
        $id=Tournaments::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/tournament/' . $id . '/edit');
        $response->assertStatus(200);
    }
    /** @test  */
    public function tourn_update(){
        $id=Tournaments::first()->id;
        $user=User::first();
        Auth::login($user);
        
        $response=$this->put('api/tournament/' . $id . '/edit',[
            'name'=>fake()->name(),
            'description'=>fake()->text(),
            'maxPlaces'=>'100',
            'rewards'=>fake()->text(),
            'requirements'=>fake()->text(),
            'sportType'=>fake()->sentence(6),
            'startDate'=>'2023-12-29',
            'endDate'=>'2023-12-30',
            'duration'=>'12:00:00',
            'timeLeft'=>'12:00:00',
            'type'=>fake()->sentence(6)     
        ]);
        $response->assertStatus(200);
    }
   

    /** @test  */
    public function tourn_member(){
        $id=Tournaments::first()->id;

        $response=$this->get('api/tournament/'. $id .'/members');
        $response->assertStatus(200);
    }
    /** @test  */
    public function tourn_enrollMember(){
        $id=Tournaments::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->post('api/enroll/user/'. $user->id .'/tournament/'. $id);
        $response->assertStatus(200);
    }

    /** @test  */
    public function tourn_games(){
        $id=Tournaments::first()->id;

        $response=$this->get('api/tournament/'. $id .'/games');
        $response->assertStatus(200);
    }

    /** @test  */
    public function tourn_createGames(){
        $id=Tournaments::first()->id;
        $user=User::first();
        $user2=User::latest()->first();
        Auth::login($user);
        $response=$this->post('api/enroll/user/'. $user->id .'/tournament/'. $id);
        $response=$this->post('api/enroll/user/'. $user2->id .'/tournament/'. $id);

        $response=$this->post('api/tournament/' . $id . '/createGames');
        $response->assertStatus(200);
    }

    /** @test  */
    public function tourn_organizer(){
        $id=Tournaments::first()->id;
        $response=$this->get('api/tournament/' . $id . '/organizer');
        $response->assertStatus(200);
    }
    /** @test  */
    public function tourn_setWinner(){
        $tournId=Tournaments::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->put('api/tournament/'. $tournId . '/member/' . $user->id . '/winner');
        $response->assertStatus(200);
    }
    /** @test  */
    public function tourn_getWinner(){
        $id=Tournaments::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/tournament/' . $id . '/winner');
        $response->assertStatus(200);
    }
  
    /** @test  */
    public function tourn_kickMember(){
        $id=Tournaments::first()->id;
        $user=User::first();
        Auth::login($user);
        $response=$this->delete('api/kick/user/'. $user->id .'/tournament/'. $id);
        $response->assertStatus(200);
    }

     /** @test */
     public function tourn_delete(){
        $id=Tournaments::first()->id;
        $user=User::first();
        Auth::login($user);

        $response=$this->delete('api/tournament/delete/'  . $id );
        $response->assertStatus(200);
    }
    
}
