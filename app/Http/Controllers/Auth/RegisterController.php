<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Kasir;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:kasir');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showAdminRegisterForm()
    {
        return view('register', ['url' => 'admin']);
    }

    public function showKasirRegisterForm()
    {
        return view('register', ['url' => 'kasir']);
    }

    protected function createAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'password-confirm' => 'same:password',
        ]);

        $admin = Admin::create([
            'nama_admin' => $request['name'],
            'username_admin' => $request['username'],
            'password_admin' => Hash::make($request['password']),
        ]);
        Auth::guard('admin')->login($admin);
        return redirect()->intended('/beranda');
    }

    protected function createKasir(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'password-confirm' => 'same:password',
        ]);
        $kasir = Kasir::create([
            'nama_kasir' => $request['name'],
            'username_kasir' => $request['username'],
            'password_kasir' => Hash::make($request['password']),
        ]);
        // Auth::guard('kasir')->login($kasir);
        return redirect()->intended('/datauser');
    }
}
