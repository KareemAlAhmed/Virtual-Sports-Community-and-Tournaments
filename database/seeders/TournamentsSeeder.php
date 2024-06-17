<?php

namespace Database\Seeders;

use App\Models\Tournaments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TournamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
    
    public function run(): void
    {
        $types=["fortnite","dota","CS","LOL","PUBG","apex","football","Overwatch","fifa"];
        Tournaments::factory(10)->create(["sportType"=>array_rand($types,1)]);
    }
}
