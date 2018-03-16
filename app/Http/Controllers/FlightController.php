<?php

namespace App\Http\Controllers;

use App\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightController extends Controller
{
    public function index()
    {
    	return view('flight.index');
    }

    public function list(Request $request)
    {
        var_dump($request->all());die;
    	return view('flight.list');
    }

   	public function detail()
   	{
   		return view('flight.detail');
   	}

    public function run()
    {
        $airline = Airline::select('id')->get();
        \App\Flight::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $random = random_int(0 , 50);
            \App\Flight::create([
                'flight_code' => $faker->postcode . $faker->countryCode,
                'from_date' => $faker->date(),
                'to_date' => $faker->date(),
                'flight_time' => $faker->time(),
                'arrival_time' => $faker->time(),
                'from_city_name' => $faker->city,
                'to_city_name' => $faker->city,
                'airline_id' => $airline[$random]->id,
                'price' => $faker->numberBetween(1000000, 10000000)
            ]);
        }
    }
}
