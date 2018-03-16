<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Airline;
class AirlineController extends Controller
{
    public function run() {
        \App\Airline::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            \App\Airline::create([
                'airline_name' => $faker->company,
                'city_name' => $faker->city,
            ]);
        }
    }

    public function store(Request $request)
    {
        echo 12;
    }
}
