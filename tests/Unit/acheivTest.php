<?php

namespace Tests\Unit;

use App\Models\Acheivements;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class acheivTest extends TestCase
{
    /** @test */
     public function acheiv_create(){
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
        ];
        
        Auth::login($user);
        $response= $this->post('api/acheive',$info);
        $response->assertStatus(201);
    }
    /** @test  */
    public function acheiv_show(){
        $id=Acheivements::first()->id;
        $response=$this->get('api/acheive/' . $id);
        $response->assertStatus(200);
    }
    /** @test  */
    public function acheiv_edit(){
        $ach=Acheivements::first();
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/acheive/' . $ach->id . ' /edit');
        $response->assertStatus(200);
    }
    /** @test  */
    public function acheiv_update(){
        $ach=Acheivements::first();
        $user=User::first();
        Auth::login($user);
        $info=['name'=>fake()->name(),
        'description'=>'krjlrflekrfwe.rknwe',
        'requirementToAcheive'=>'ljqfnejkrfh wkejrfh wkejf wkejrfkwe',
        'sportType'=>'rfjrfherjfenfjen',
        'image_url'=>'fekrfjekrfmke',
        'video_url'=>'njenrfejnrfe',
        ];
        $response=$this->put('api/acheive/' . $ach->id . ' /edit',$info);
        $response->assertStatus(200);
    }
    /** @test  */
    public function acheiv_user(){
        $ach=Acheivements::first();
        $response=$this->get('api/acheivement/' . $ach->id . ' /user');
        $response->assertStatus(200);
    }
    /** @test  */
    public function acheiv_giveUser(){
        $ach=Acheivements::first();
        $user=User::first();
        Auth::login($user);

        $response=$this->post('api/acheivement/' . $ach->id . ' /user/' . $user->id);
        $response->assertStatus(200);
    }
    /** @test  */
    public function acheiv_delete(){
        $ach=Acheivements::first();
        $user=User::first();
        Auth::login($user);

        $response=$this->delete('api/acheive/' . $ach->id . ' /delete');
        $response->assertStatus(200);
    }
}
