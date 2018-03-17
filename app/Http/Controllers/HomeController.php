<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function setSession(Request $request) {
        Session::put('token', $request->token);
        Session::put('role', $request->role);
        Session::put('username', $request->username);
        return response()->json(['message' => 'ok'], 200);
    }
}
