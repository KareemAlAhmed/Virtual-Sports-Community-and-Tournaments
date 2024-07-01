<?php

namespace Database\Seeders;

use App\Models\Follower;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Follower::factory()->create(["follower_id"=>2,"followed_id"=>1,"status"=>"Accepted"]);
        Follower::factory()->create(["follower_id"=>3,"followed_id"=>1,"status"=>"Accepted"]);
        Follower::factory()->create(["follower_id"=>4,"followed_id"=>1,"status"=>"Accepted"]);
        Follower::factory()->create(["follower_id"=>5,"followed_id"=>1,"status"=>"Pending"]);
        Follower::factory()->create(["follower_id"=>1,"followed_id"=>2,"status"=>"Accepted"]);
        Follower::factory()->create(["follower_id"=>1,"followed_id"=>3,"status"=>"Pending"]);
    }
}
