<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TravelController extends Controller
{
    public function index(){
        return Travel::all();
    }

    public function show($id){
        $travel = response()->json(Travel::find($id));
        return $travel;
    }

    public function store(Request $request){
        $travel = new Travel();
        $travel->evaluation = $request->evaluation;
        $travel->flight_id = $request->flight_id;
        $travel->user_id = $request->user_id;
        $travel->save();
    }

    public function update(Request $request, $id){
        $travel = Travel::find($id);
        $travel->evaluation = $request->evaluation;
        $travel->flight_id = $request->flight_id;
        $travel->user_id = $request->user_id;
        $travel->save();
    }

    public function destroy($id){
        Travel::find($id)->delete();
    }

    public function travelAuthUsers(){
        return Travel::with('user_travel')->where(Auth::user()->id, '=' ,'user_id')->get();
    }

    public function showUserFlightsByAirlineCountry($country){
        $userId = auth()->id();
        $flights = DB::table('travel')
        ->join('flights','travel.flights_id', '=', 'flights.flights_id')
        ->join('airlines','flights.airlines_id', '=', 'airlines.airlines_id')
        ->where('airlines.country', $country)
        ->where('travel.user_id', $userId)
        ->select('flights.*')
        ->get();

        return response()->json($flights);
        
    }
}
