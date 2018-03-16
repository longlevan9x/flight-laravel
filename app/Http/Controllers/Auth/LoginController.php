<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            if (Session::has('users')) {
                return redirect('home');
            }
            return view('auth.login');
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $user->token = str_random(60);
            $user->save();
            unset($user['password']);
            return response()->json([
                'status' => 'success',
                'user' => $user
            ], 200);
        }

        return response()->json(['error' => 'Wrong email or password'], 401);
    }

    public function logout(Request $request)
    {
        var_dump(Auth::logout());
        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
