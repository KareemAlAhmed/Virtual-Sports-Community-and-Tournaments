<?php

namespace Database\Seeders;

use App\Models\Leagues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaguesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types=["fortnite","dota","CS","LOL","PUBG","apex","football","Overwatch","fifa"];
        Leagues::factory(10)->create(["sportType"=>array_rand($types,1)]);
    }
}
