<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class AirportArrivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Airport $airport)
    {
        return $airport->arrivals;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($airport_id, $arrival_id)
    {
        return Flight::findOrFail($arrival_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Airport $airport)
    {
        $request->validate([
            'code' => 'required|string',
            'gate' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|date_format:H:i:s',
            'departure_time' => 'required|date|before:arrival_time',
            'arrival_time' => 'required|date|after:departure_time',
            'departure_id' => 'required|exists:airports,id',
            'arrival_id' => 'prohibited',
            'airline_id' => 'required|exists:airlines,id',
        ]);

        $flight = new Flight($request->all());

        $airport->arrivals()->save($flight);

        return $flight;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Airport $airport, $id)
    {
        $request->validate([
            'code' => 'required|string',
            'gate' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|date_format:H:i:s',
            'departure_time' => 'required|date|before:arrival_time',
            'arrival_time' => 'required|date|after:departure_time',
            'departure_id' => 'required|exists:airports,id',
            'arrival_id' => 'prohibited',
            'airline_id' => 'required|exists:airlines,id',
        ]);

        $flight = Flight::findOrFail($id);

        $flight->update($request->all());

        return $flight;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Airport $airport, $id)
    {
        Flight::findOrFail($id)->delete();
    }
}
