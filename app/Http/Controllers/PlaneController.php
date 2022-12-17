<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaneRequest;
use App\Http\Requests\UpdatePlaneRequest;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Plane::class, 'plane');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Plane::with('airline')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plane  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Plane $plane)
    {
        return $plane;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlaneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'seats' => 'required|numeric',
            'airline_id' => 'required|exists:airlines,id'
        ]);

        $plane = Plane::create($request->all());

        return $plane->load('airline');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlaneRequest  $request
     * @param  \App\Models\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plane $plane)
    {
        $request->validate([
            'model' => 'required|string',
            'seats' => 'required|numeric',
            'airline_id' => 'required|exists:airlines,id'
        ]);

        $plane->update($request->all());

        return $plane->load('airline');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plane  $plane
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plane $plane)
    {
        $plane->delete();
    }
}
