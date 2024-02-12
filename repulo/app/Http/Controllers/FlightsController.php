<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightsController extends Controller
{
    public function index()
    {
        return Flight::all();
    }

    public function show($id)
    {
        $flights = response()->json(Flight::find($id));
        return $flights;
    }

    public function store(Request $request)
    {
        $flights = new Flight();
        $flights->date = $request->date;
        $flights->airline_id = $request->airline_id;
        $flights->limit = $request->limit;
        $flights->status = $request->status;
        $flights->save();
    }

    public function update(Request $request, $id)
    {
        $flights = Flight::find($id);
        $flights->date = $request->date;
        $flights->airline_id = $request->airline_id;
        $flights->limit = $request->limit;
        $flights->status = $request->status;
        $flights->save();
    }

    public function destroy($id)
    {
        Flight::find($id)->delete();
    }

    public function flightDelete($flight_id)
    {
        $flights = Flight::find($flight_id);
        $flights->status = 0;
        $flights->save();

        return DB::table('flights')
            ->where('airlines.name', $flight_id)
            ->update([
                'evaluation' =>'deleted'
            ]);
    }
    
    public function airlineDelete($name)
    {
        $flights = DB::table('flights')
            ->join('airlines', 'flights.airlines_id', '=', 'airlines.airlines_id')
            ->where('airlines.name', $name)
            ->whereDate('flights.date', '=', now())
            ->delete();

        return response()->json($flights);

    }
}
