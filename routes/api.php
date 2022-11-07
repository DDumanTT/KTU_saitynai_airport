<?php

use App\Http\Controllers\AirportController;
use App\Http\Controllers\AirportArrivalController;
use App\Http\Controllers\AirportDepartureController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PlaneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('cities', CityController::class);
    Route::apiResource('airports', AirportController::class);
    Route::apiResource('airports.departures', AirportDepartureController::class)->scoped();
    Route::apiResource('airports.arrivals', AirportArrivalController::class)->scoped();
    Route::apiResource('airlines', AirlineController::class);
    Route::apiResource('flights', FlightController::class);
    Route::apiResource('planes', PlaneController::class);
});
