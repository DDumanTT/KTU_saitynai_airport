<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => fake()->bothify('??####'),
            'gate' => fake()->bothify('?#'),
            'duration' => fake()->time(),
            'departure_time' => fake()->dateTime(),
            'arrival_time' => fake()->dateTime(),
            'price' => fake()->randomFloat(2, 0, 1000)
        ];
    }
}
