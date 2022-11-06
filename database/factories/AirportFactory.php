<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->address(),
            'code' => fake()->regexify("[A-Z]{3,4}/[A-Z]{3,4}"),
            'city_id' => function () {
                if ($city = City::all()->random()) {
                    return $city->id;
                }
                return City::factory()->create()->id;
            }
        ];
    }
}
