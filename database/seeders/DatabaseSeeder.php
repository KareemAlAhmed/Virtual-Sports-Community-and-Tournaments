<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\enrollLeagueController;
use App\Http\Controllers\enrollTournController;
use App\Models\Posts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create(['id'=>1,"name"=>"kareem","email"=>"karimahmad@gmail.com",'image_url'=>'images.jpeg',"password"=>"$2y$10$5./GxZT0iTzuZVagUFAlOe8V.WUIi8zSCh4fWvLRRrZ.IHa7uCUDm"]);
        User::factory(1)->create(['id'=>5,'image_url'=>'images.jpeg']);
        User::factory(1)->create(['id'=>2,'image_url'=>'images.jpeg']);
        User::factory(1)->create(['id'=>3,'image_url'=>'images.jpeg']);
        User::factory(1)->create(['id'=>4,'image_url'=>'images.jpeg']);
        Posts::factory(5)->create(['user_id'=>1,'image_url'=>'images.jpeg']);
        Posts::factory(5)->create(['user_id'=>2,'image_url'=>'images.jpeg']);
        Posts::factory(5)->create(['user_id'=>3,'image_url'=>'images.jpeg']);
        Posts::factory(5)->create(['user_id'=>4,'image_url'=>'images.jpeg']);
        $this->call(LeaguesSeeder::class);
        $this->call(TournamentsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FollowerSeeder::class);
        $users=User::all();
        for($i = 0; $i < 10;$i++){
           $tourn=new enrollLeagueController();
           $tourn->enroll($users[$i]['id'],1);
        }
        for($i = 0; $i < 16;$i++){
           $tourn=new enrollTournController();
           $tourn->enroll($users[$i]['id'],1);
        }

    }
}
