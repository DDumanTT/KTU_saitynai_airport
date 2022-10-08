<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // TODO: make seeder
        Airport::factory()->count(5)->create();
        Flight::factory()->count(10)->hasPlane()->create();
        //     Airport::factory()->count(5)->each(function ($item) {
        //         $flights = Flight::all();
        //         $rand = $flights->random();
        //         $item->departure()->associate($rand);
        //         $item->arrival()->associate($flights->whereNotIn('id', [$rand->id])->random());
        //     })->create();
    }
}
