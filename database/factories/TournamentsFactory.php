<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TournamentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'maxPlaces' => fake()->numberBetween(1,100),
            'remainingPlaces' => fake()->numberBetween(1,100),
            'rewards' => fake()->numberBetween(1,100),
            'requirements'=>fake()->text(),
            'sportType'=>fake()->word(),
            'startDate'=>fake()->date(),
            'endDate'=>fake()->date(),
            'organizer_id'=>'51',
            'type'=>fake()->word()
        ];
    }
}
