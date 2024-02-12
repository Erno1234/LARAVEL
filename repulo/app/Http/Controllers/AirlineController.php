<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index(){
        return Airline::all();
    }

    public function show($id){
        $airline = response()->json(Airline::find($id));
        return $airline;
    }

    public function store(Request $request){
        $airline = new Airline();
        $airline->name = $request->name;
        $airline->country = $request->country;
        $airline->save();
    }

    public function update(Request $request, $id){
        $airline = Airline::find($id);
        $airline->name = $request->name;
        $airline->country = $request->country;
        $airline->save();
    }

    public function destroy($id){
        Airline::find($id)->delete();
    }

    public function oneAirlineFlights($airline_id){
        return Airline::with('flight')->where('airline_id', $airline_id->get());
    }
}
