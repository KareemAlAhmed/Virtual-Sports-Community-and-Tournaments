<?php

namespace Tests\Unit;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class postTest extends TestCase
{
    /** @test */
    public function post_create(){
        $user=User::first();
        Auth::login($user);
        $content= fake()->paragraph();
        
        $response=$this->post('api/post/user/' . $user->id,[
            'content'=> $content
        ]);
        $response->assertStatus(201);
    }
    /** @test */
    public function post_show(){
        $response=$this->get('api/post/' . User::first()->id);
        $response->assertStatus(200);
    }
    /** @test */
    public function post_edit(){
        $user=User::first();
        Auth::login($user);
        $response=$this->get('api/post/' . Posts::latest()->first()->id . '/edit');
        $response->assertStatus(200);
    }
    /** @test */
    public function post_update(){
        $user=User::first();
        Auth::login($user);
        $content= fake()->paragraph();
        $response=$this->put('api/post/' .  Posts::latest()->first()->id . '/edit',[
            'content'=> $content
        ]);
        $response->assertStatus(200);
    } 
    /** @test */
    public function post_delete(){
        $user=User::first();
        Auth::login($user);

        $response=$this->delete('api/post/' .  Posts::latest()->first()->id . '/delete');
        $response->assertStatus(200);
    } 
    /** @test */
    public function post_user(){
        $user=User::first();
        Auth::login($user);

        $response=$this->get('api/post/' .  Posts::latest()->first()->id . '/user');
        $response->assertStatus(200);
    } 
}
