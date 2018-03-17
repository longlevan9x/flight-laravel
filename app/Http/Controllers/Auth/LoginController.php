<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            if (Session::has('token')) {
                return redirect('home');
            }
            return view('auth.login');
        }
        /** @var User $request */
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var User $user */
            $user = Auth::user();
            $user->api_token = str_random(60);
            $user->save();
            return response()->json([
                'status' => 'success',
                'result' => [
                    'name' => $user->username,
                    'token' => $user->api_token,
                    'role' => $user->role
                ]
            ], 200);
        }

        return response()->json(['error' => 'Wrong email or password'], 401);
    }

    public function logout(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
//        $user->generateToken(true);
        Session::forget('username');
        Session::forget('token');
        Session::forget('role');
        Auth::logout();
        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
