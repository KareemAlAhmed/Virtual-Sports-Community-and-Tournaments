<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class userTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    /** @test */
    public function insert_new_user(){
        $user=['name' => fake()->name(),'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'image_url'=>'kkkksfwfwf.jpg',
        'bio'=>fake()->text()];
        
       
        $response=$this->post('api/register',$user);

            $response->assertStatus(201);
        
    }
/** @test */
    public function login_user(){


        $response=$this->post('/api/login',[
            
            'email'=>'karimahmad53@gmail.com',
            'password'=>'81258136',

        ]);
        $response->assertStatus(200);
    }
/** @test */
    public function logout_user(){

        $user=new User;
        $user->name= fake()->name();
        $user->password='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->bio=fake()->text();
        $user->email=fake()->unique()->safeEmail();

        $user->save();
        $token=$user->createToken('myapptoken')->plainTextToken;
        $info=['name'=>fake()->name(),
        'description'=>'krjlrflekrfwe.rknwe',
        'requirementToAcheive'=>'ljqfnejkrfh wkejrfh wkejf wkejrfkwe',
        'sportType'=>'rfjrfherjfenfjen',
        'image_url'=>'fekrfjekrfmke',
        'video_url'=>'njenrfejnrfe',
        'token'=>$token];
        
        Auth::login($user);
        $response=$this->post('/api/logout',$info);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_acheiv(){
        $response= $this->get('api/user/1/acheivements');
        $response->assertStatus(200);
    }
    /** @test */
    public function user_post(){
        $response= $this->get('api/user/1/posts');
        $response->assertStatus(200);
    }
    /** @test */
    public function user_tournament(){
        $response= $this->get('api/user/1/tournaments');
        $response->assertStatus(200);
    }
    /** @test */
    public function user_league(){
        $response= $this->get('api/user/1/leagues');
        $response->assertStatus(200);
    }
    /** @test */
    public function user_tournGames(){
        $response= $this->get('api/user/1/tournaments/games');
        $response->assertStatus(200);
    }
    /** @test */
    public function user_leagueGames(){
        $response= $this->get('api/user/1/leagues/games');
        $response->assertStatus(200);
    }
}
