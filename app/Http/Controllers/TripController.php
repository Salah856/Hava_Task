<?php

namespace App\Http\Controllers;
use App\Trip; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        return view('single_trip', compact('trip'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function search(Request $request)
    {
        $trips = Trip::when($request->has('keyword'), function($query) use ($request) {
            $keyword = $request->get('keyword');
            $query->search($keyword); // This is scopeSearch in the model
        })
        ->when($request->has('radioDistance'), function($query) use ($request) {
            $DistanceValue = $request->get('radioDistance');

            if($DistanceValue == '3-8' || $range == '8-15'){
                $parts = explode('-', $DistanceValue);
                $query->distanceRange($parts[0], $parts[1]);
            }
            elseif($DistanceValue == '1000'){
                $query->distanceAboveFifteenKm();
            } 
            elseif($DistanceValue == '1'){
                $query->distanceUnderThreeKm();
            } 
            // scopeDistanceRange in the model
        })
        ->when(!$request->has('cancelledTrips'), function($query) {
            $query->where('status', 0);
        })
        ->when($request->has('radioTime'), function($query) use ($request){
            if($DurationValue == '5-10' || $range == '10-20'){
                $parts = explode('-', $DistanceValue);
                $query->durationRange($parts[0], $parts[1]);
            }
            elseif($DistanceValue == '100'){
                $query->duartionAboveTewentyMin();
            } 
            elseif($DistanceValue == '1'){
                $query->durationUnderFiveMin();
            } 
        })->get();
        
        $count = 0; 
        foreach($trips as $trip){
            $count = $count+1; 
        }
    
        return view('trips.search_result', ['trips' => $trips, 'count' => $count]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
