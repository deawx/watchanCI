<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $request->validate([
            'code' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);
        $user = DB::table('users')
                ->where('users.code', $request->code)
                ->first();;
            // return dd($user);
        if (auth()->attempt($credentials)) {
            return redirect()->route('home');
        }else{
            return back()->with('valid','ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
