<?php

namespace App\Http\Controllers\Api;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $model = Transaction::create($request->all());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function transaction(Request $request) {
//        title (Mr, Mrs, Miss, Dr)
// first_name (User‟s first name)
// last_name (User‟s last name)
// email
// phone
// payment_method (transfer, credit card or paypal)
// card_name (if pay by credit card)
// card_number (if pay by credit card)
// ccv (if pay by credit card)
//Response result
        /** @var Transaction $request */
        /** @var Transaction $transaction */
        $transaction = Transaction::create([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'ccv' => $request->ccv,
        ]);
        /** @var \Illuminate\Contracts\Validation\Validator $validator */
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'card_number' => 'required',
            'ccv' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'fail',
                'text' => 'Transaction'
            ], 422);
        }

        if ($transaction) {
            $transaction->payment_status = 'success';
            $transaction->save();
            return response()->json([
                'message' => 'ok',
                'result' => [
                    'payment_status' => $transaction->payment_status,
                    'transaction_id' => $transaction->id
                ]
            ], 200);
        }
        $transaction->payment_status = 'error';
        $transaction->save();
        return response()->json([
            'message' => 'fail',
            'text' => 'fail',
            'result' => [
                'payment_status' => $transaction->payment_status
            ]
        ], 404);
    }
}
