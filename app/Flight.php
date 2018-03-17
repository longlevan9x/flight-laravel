<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'flight_code',
        'from_date',
        'to_date',
        'flight_time',
        'departure_time',
        'arrival_time',
        'from_city_name',
        'to_city_name',
        'airline_id',
        'price'
    ];
}
