<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        //\App\Models\User::factory(1)->create(['id'=>1]);
        //\App\Models\User::factory(1)->create(['id'=>2]);
        //\App\Models\User::factory(1)->create(['id'=>3]);
        //\App\Models\User::factory(1)->create(['id'=>4]);
        //Posts::factory(5)->create(['user_id'=>1,'image_url'=>'images.jpeg']);
        //Posts::factory(5)->create(['user_id'=>2,'image_url'=>'images.jpeg']);
        //Posts::factory(5)->create(['user_id'=>3,'image_url'=>'images.jpeg']);
        //Posts::factory(5)->create(['user_id'=>4,'image_url'=>'images.jpeg']);
        $users=User::all();
        for($i = 0; $i < 6;$i++){
           $tourn=new enrollTournController();
           $tourn->enroll($users[$i]['id'],3);
        }
    }
}
