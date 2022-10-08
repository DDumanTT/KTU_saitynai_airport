<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaneRequest;
use App\Http\Requests\UpdatePlaneRequest;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Plane::all();
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
            'flight_id' => 'required|exists:flights,id'
        ]);

        return Plane::create($request->all());
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
            'flight_id' => 'required|exists:flights,id'
        ]);

        $plane->update($request->all());

        return $plane;
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
