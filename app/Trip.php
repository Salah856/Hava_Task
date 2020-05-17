<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    protected $fillable=[
        'pickUpLocation', 
        'dropOffLocation',
        'requestTime',
        'tripStart',
        'tripEnd',
        'distance',
        'duration',
        'finalPrice',
        'driverName',
        'rate', 
        'status',
        'driverPicture',
        'driverCar', 
        'carModel', 
        'keyword'
    ];

    


    // scopes of distance  of trip 
    
    public function scopeDistanceRange($query, $from, $to){
        return $query->whereBetween('distance',[$from, $to]); 
    }

    public function scopeDistanceUnderThreeKm($query, $from, $to){
        return $query->where('distance','<', 3); 
    }

    public function scopeDistanceAboveFifteenKm($query){
        return $query->where('radioDistance','>', 15); 
    }


    // scope of search

    public function scopeSearch($query, $keyword){
        return $query->where($keyword, 'LIKE', "%$keyword%");
    }

    //scopes of duration of trip 

    public function scopeDurationRange($query){
        return $query->whereBetween('duration',[$from, $to]); 
    }

    public function scopeDurationUnderFiveMin($query, $from, $to){
        return $query->where('duration','<', 5); 
    }

    public function scopeDurationAboveTwentyMins($query, $from, $to){
        return $query->where('duration','>', 20); 
    }

}
