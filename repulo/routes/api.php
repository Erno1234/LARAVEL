<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//bejelentkezett felhasználó útvonalai itt lesznek
Route::middleware('auth.basic')->group(function () {
    Route::get('auth_travel_user', [TravelController::class, 'travelAuthUsers']);
    Route::get('airline_by_country', [TravelController::class, 'showUserFlightsByAirlineCountry']);
    Route::delete('airline_delete/{name}', [FlightsController::class, 'airlineDelete']);
});

Route::get('airlines', [AirlineController::class, 'index']);
Route::get('airlines/{id}', [AirlineController::class, 'show']);
Route::post('airlines', [AirlineController::class, 'store']);
Route::put('airlines/{id}', [AirlineController::class, 'update']);

Route::get('one_airline_flights/{airline_id}', [AirlineController::class, 'oneAirlineFlights']);
Route::patch('flight_delete/{flight_id}', [FlightsController::class, 'flightDelete']);
