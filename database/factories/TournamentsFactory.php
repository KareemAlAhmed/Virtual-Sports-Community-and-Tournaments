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
        // $number=rand(1,64);
        // while($number % 4 != 0){
        //     $number=rand(1,64);
        // }
        $types=["Friendly","bypoints","knockout"];
        return [
            
            'name' => fake()->name(),
            'description' => fake()->text(),
            'maxPlaces' => 16,
            'remainingPlaces' => 16,
            'rewards' => fake()->numberBetween(1,100),
            'requirements'=>fake()->text(),
            'sportType'=>fake()->word(),
            'startDate'=>fake()->date(),
            'endDate'=>fake()->date(),
            'organizer_id'=>'1',
            'type'=>$types[array_rand($types,1)] 
        ];
    }
}
