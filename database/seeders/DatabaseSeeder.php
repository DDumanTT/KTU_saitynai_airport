<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Airline;
use Illuminate\Database\Seeder;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Plane;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Airport::factory()->count(5)->create();

        Airline::factory()->count(5)->hasPlanes(3)->create();

        Flight::factory()->count(10)->create();
    }
}
