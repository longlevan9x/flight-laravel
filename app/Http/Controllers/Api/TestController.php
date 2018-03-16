<?php

namespace App\Http\Controllers\Api;

use App\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (new Test)->paginate(4);
        return response()->json(['message' => 'ok', 'result' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Test|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (new Test)->create($request->all());
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Test $test
     * @return Test
     */
    public function show(Test $test)
    {
        return $test;
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
        $model = (new Test)->findOrFail($id);
        $model->update($request->all());
        return response()->json($model, 200);
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
        $model = (new Test)->findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
        //
    }
}
