<?php

namespace App\Http\Controllers\Api;

use App\Flight;
use App\FlightBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FlightBook::paginate(100);
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
            'airline_id' => 'required',
            'flight_type' => 'required',
            'from_date' => 'required',
            'from_time' => 'required',
            'return_date' => 'required',
            'return_time' => 'required',
            'from_city_name' => 'required',
            'to_city_name' => 'required',
            'flight_class' => 'required',
            'total_adults' => 'required',
            'total_children' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $model = FlightBook::create($request->all());
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
        $model = FlightBook::find($id);
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
        $model = FlightBook::findOrFail($id);
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
        /** @var FlightBook $model */
        $model = FlightBook::find($id);
        if (isset($model) && !empty($model)) {
            $model->delete();
            return response()->json(['message' => 'ok'], 200);
        }
        else {
            return response()->json(['message' => 'fail', 'text' => 'Airline not found'], 400);
        }
        //
    }

    /**
     * @param Request $request
     */
    public function bookAFlight(Request $request) {
        /** @var FlightBook $request */
        $conditions = [
            'flight_type' => $request->flight_type,
            'from_date' => $request->from_date,
            'from_time' => $request->from_time,
            'return_date' => $request->flight_type,
            'return_time' => $request->flight_type,
            'from_city_name' => $request->flight_type,
            'to_city_name' => $request->flight_type,
            'flight_class' => $request->flight_type,
            'total_adults' => $request->flight_type,
            'total_children' => $request->flight_type,
            'airline_id' => $request->airline_id,
        ];
        FlightBook::create($conditions);
        $flight_book = FlightBook::where()->get();
    }

    /**
     * @param FlightBook $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchFlight(Request $request) {
        $condition = [
            'from_date' => $request->from_date,
            'from_city_name' => $request->from_city_name,
            'to_city_name' => $request->to_city_name,
            'flight_type' => $request->flight_type,
            'flight_class' => $request->flight_class,
        ];
        if ($request->flight_type === 'return') {
            $condition += ['return_date' => $request->return_date];
        }
        $flight = FlightBook::where($condition)->get();
        return response()->json(['message' => 'ok' , 'result' => $flight], 200  );
    }
}
