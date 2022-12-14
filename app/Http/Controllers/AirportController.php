<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAirportRequest;
use App\Http\Requests\UpdateAirportRequest;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Airport::class, 'airport');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Airport::with('city')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Airport $airport)
    {
        return $airport;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAirportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'code' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        $airport = Airport::create($request->all());

        return $airport->load('city');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAirportRequest  $request
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Airport $airport)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'code' => 'required|string',
            'city_id' => 'required|exists:cities,id'
        ]);

        $airport->update($request->all());

        return $airport->load('city');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Airport $airport)
    {
        $airport->delete();
    }
}
