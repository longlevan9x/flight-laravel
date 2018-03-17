<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed flight_type
 * @property mixed airline_id
 * @property mixed from_date
 * @property mixed from_time
 * @property mixed from_city_name
 * @property mixed to_city_name
 * @property mixed flight_class
 * @property mixed return_date
 */
class FlightBook extends Model
{
    //
    protected $fillable = [
        'airline_id',
    	'flight_type',
        'from_date',
        'from_time',
        'return_date',
        'return_time',
        'from_city_name',
        'to_city_name',
        'flight_class',
        'total_adults',
        'total_children',
//        'first_name',
//        'last_name',
	];
}
