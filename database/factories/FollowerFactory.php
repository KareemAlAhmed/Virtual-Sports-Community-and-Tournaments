<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follower>
 */
class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "follower_id"=>fake()->numberBetween(2,10),
            "followed_id"=>fake()->numberBetween(2,10),
            "status"=>"Pending",


        ];
    }
}
