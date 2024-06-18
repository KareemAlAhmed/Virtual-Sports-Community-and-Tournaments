<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leagues>
 */
class LeaguesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types=["fortnite","dota","CS","LOL","PUBG","apex","football","Overwatch","fifa"];

        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'maxPlaces' => 10,
            'remainingPlaces' => 10,
            'rewards' => fake()->numberBetween(1,100),
            'requirements'=>fake()->text(),
            'sportType'=>$types[array_rand($types,1)],
            'startDate'=>fake()->date(),
            'endDate'=>fake()->date(),
            'organizer_id'=>'1',
        ];
    }
}
