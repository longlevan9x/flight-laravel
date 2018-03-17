<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Flight;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Flight::paginate(100);
        return response()->json(['message' => 'ok', 'result' => $data], 200);
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
        /** @var \Illuminate\Contracts\Validation\Validator $validator */
        $validator = Validator::make($request->all(), [
            'flight_code' => 'required|unique:flights',
            'from_date' => 'required',
            'to_date' => 'required',
            'flight_time' => 'required',
//            'departure_time' => 'required',
            'arrival_time' => 'required',
            'from_city_name' => 'required',
            'to_city_name' => 'required',
            'airline_id' => 'required',
            'price' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $model = Flight::create($request->all());
        return response()->json(['message' => 'ok', 'result' => $model]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Flight::find($id);
        return response()->json(['message' => 'ok', 'result' => $model], 200);
        //
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
        $model = Flight::findOrFail($id);
        $model->update($request->all());
        return response()->json(['message' => 'ok', 'result' => $model], 200);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Flight $model */
        $model = Flight::find($id);
        if (isset($model) && !empty($model)) {
            $model->delete();
            return response()->json(['message' => 'ok'], 200);
        }
        else {
            return response()->json(['message' => 'fail', 'text' => 'Airline not found'], 400);
        }
        //
    }

    public function getFlight($DEPARTURE_DATE, $DEPARTURE_CITY_NAME, $DESTINATION_CITY_NAME) {
        $condition = [
            'from_date' => $DEPARTURE_DATE,
            'from_city_name' => $DEPARTURE_CITY_NAME,
            'to_city_name' => $DESTINATION_CITY_NAME
        ];

        $flight = Flight::select([
            'id as flight_id', 'flight_code', 'flight_time as departure_time', 'arrival_time', 'airline_id', 'to_city_name as airline_name', 'from_date as departure_date', 'from_city_name as departute_city_name'
            ])->where($condition)->get();
        Session::put('flightList', $flight);
        if (isset($flight) && !empty($flight)) {
            return response()->json(['message' => 'ok' , 'result' => $flight], 200  );
        }
        else {
            return response()->json(['message' => 'fail' , 'result' => []], 404);
        }
    }
}
