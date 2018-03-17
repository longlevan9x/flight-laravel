<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Airline;
use Illuminate\Support\Facades\Validator;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (new Airline)->paginate(100);
        return response()->json(['message' => 'ok', 'result' => $data]);
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
            'airline_name' => 'required|string|max:255|unique:airlines',
            'city_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $model = Airline::create($request->all());
        return response()->json(['message' => 'ok', 'result' => $model], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $model = Airline::findOrFail($id);
        return response()->json(['message' => 'ok', 'result' => $model], 200);
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
        $model = Airline::findOrFail($id);
        $model->update($request->all());
        return response()->json(['message' => 'ok', 'result' => $model], 200);
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
        $model = Airline::find($id);
        if (isset($model) && !empty($model)) {
            $model->delete();
            return response()->json(['message' => 'ok'], 200);
        }
        else {
            return response()->json(['message' => 'fail', 'text' => 'Airline not found'], 400);
        }
    }
}
