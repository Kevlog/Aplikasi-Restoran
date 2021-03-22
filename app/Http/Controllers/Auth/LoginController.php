<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:kasir')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {        
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($admin = Auth::guard('admin')->attempt(['username_admin' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            // Auth::guard('admin')->login($admin);
            return redirect()->intended('/beranda');
        }
        return back()->withInput($request->only('username', 'remember'));
    }

    public function showKasirLoginForm()
    {
        return view('login', ['url' => 'kasir']);
    }

    public function kasirLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('kasir')->attempt(['username_kasir' => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/pesanan');
        }
        return back()->withInput($request->only('username', 'remember'));
    }    
}
