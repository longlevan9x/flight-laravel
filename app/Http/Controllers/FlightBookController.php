<?php

namespace App\Http\Controllers;

use App\Airline;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FlightBookController extends Controller
{
    public function run() {
//        flight_type (One way only or with return flight)
// from_date
// from_time
// return_date (if not one way flight)
// return_time (if not one way flight)
// from_city_name
// to_city_name
// flight_class (Economy, Business or First class)
// total_adults
// total_children
// passengers consist of first_name, last_name (array of passengers‟s first name and last
//name)
        $airline = Airline::select('id')->get();
        \App\FlightBook::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $random = random_int(0 , 49);
            \App\FlightBook::create([
                'airline_id' => $airline[$random]->id,
                'flight_type' => ['one-way', 'return'][random_int(0,1)],
                'flight_code' => $faker->postcode . $faker->countryCode,
                'from_date' => $faker->date(),
                'from_time' => $faker->time(),
                'return_date' => $faker->date(),
                'return_time' => $faker->time(),
                'from_city_name' => $faker->city,
                'to_city_name' => $faker->city,
                'total_adults' => random_int(0,50),
                'total_children' => random_int(0,50),
                'flight_class' => ['economy', 'business', 'first class'][rand(0,2)],
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
            ]);
        }
    }
}
