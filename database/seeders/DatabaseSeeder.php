<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Airline;
use Illuminate\Database\Seeder;
use App\Models\Airport;
use App\Models\City;
use App\Models\Flight;
use App\Models\Plane;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->admin()->create();

        User::factory(5)->create();

        City::factory()->count(5)->hasAirports(2)->create();

        Airport::factory()->count(5)->create();

        Airline::factory()->count(5)->hasPlanes(3)->create();

        Flight::factory()->count(10)->create();
    }
}
