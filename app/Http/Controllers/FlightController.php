<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class FlightController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Flight::class, 'flight');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departureQuery = $request->query('departure');
        $arrivalQuery = $request->query('arrival');

        $flights = Flight::with('departure.city', 'arrival.city', 'airline');

        if ($departureQuery) {
            $flights->whereHas('departure.city', function (Builder $query) use ($departureQuery) {
                $query->where('country', 'ILIKE', "%{$departureQuery}%");
            });
        };

        if ($arrivalQuery) {
            $flights->whereHas('arrival.city', function (Builder $query) use ($arrivalQuery) {
                $query->where('country', 'ILIKE', "%{$arrivalQuery}%");
            });
        };

        return $flights->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Flight $flight)
    {
        return $flight;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFlightRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'gate' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|date_format:H:i:s',
            'departure_time' => 'required|date|before:arrival_time',
            'arrival_time' => 'required|date|after:departure_time',
            'departure_id' => 'required|exists:airports,id',
            'arrival_id' => 'required|exists:airports,id',
            'airline_id' => 'required|exists:airlines,id',
        ]);

        $flight = Flight::create($request->all());

        return $flight->load('departure.city', 'arrival.city', 'airline');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFlightRequest  $request
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flight $flight)
    {
        $request->validate([
            'code' => 'required|string',
            'gate' => 'required|string',
            'duration' => 'required|date_format:H:i:s',
            'departure_time' => 'required|date|before:arrival_time',
            'arrival_time' => 'required|date|after:departure_time',
            'departure_id' => 'required|exists:airports,id',
            'arrival_id' => 'required|exists:airports,id',
            'airline_id' => 'required|exists:airlines,id',
        ]);

        $flight->update($request->all());

        return $flight->load('departure.city', 'arrival.city', 'airline');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();
    }
}
