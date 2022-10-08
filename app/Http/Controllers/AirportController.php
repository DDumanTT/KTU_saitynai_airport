<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAirportRequest;
use App\Http\Requests\UpdateAirportRequest;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Airport::all();
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
            'code' => 'required|string'
        ]);

        $airport = Airport::create($request->all());

        return $airport;
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
            'code' => 'required|string'
        ]);

        $airport->update($request->all());

        return $airport;
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
