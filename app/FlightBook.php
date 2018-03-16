<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightBook extends Model
{
    //
    protected $fillable = [
    	'flight_type', 'from_date', 'from_time', 'return_date', 'return_time', 'flight_type', 'from_city_name', 'to_city_name', 'flight_class', 'total_adults', 'total_children', 'first_name', 'last_name',
	];
}
