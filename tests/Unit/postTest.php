<?php

namespace Tests\Unit;

use Tests\TestCase;

class postTest extends TestCase
{
    /** @test */
    public function post_get(){
        $response=$this->get('api/post/1');
        $response->assertStatus(200);
    }
}
