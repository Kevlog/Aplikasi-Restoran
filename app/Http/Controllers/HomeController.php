<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Admin;
use App\Kasir;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        // $this->middleware('auth:admin');
        // $this->middleware('auth:kasir');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function menu()
    {
        return view('menu');
    }

    public function beranda()
    {
        // ->join('keranjang', 'pemesanan.id_session', '=', 'keranjang.id_session')
        $pendapatan = DB::table('pemesanan')->where('status_transaksi', 'selesai')->value(DB::Raw('SUM(pemesanan.total_harga) AS pendapatan'));
        $transaksi = DB::table('pemesanan')->count();
        $transaksitoday = DB::table('pemesanan')->whereDate('tanggal', Carbon::today())->count();
        return view('beranda', ['pendapatan' => $pendapatan, 'transaksi' => $transaksi, 'transaksitoday' => $transaksitoday]);
    }

    public function promo()
    {
        return view('promo');
    }

    public function getDataKasir()
    {
         // mengambil data dari table books
         $kasir = DB::table('kasir')->get();        
         // mengirim data books ke view books
         return view('DataKasir', ['kasir' => $kasir]);
    }

    public function hapusDataKasir($id)
    {        
        DB::table('kasir')->where('id_kasir', $id)->delete();     
        return redirect()->intended('/datauser');
    }

    protected function setDataKasir(Request $request)
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

    protected function editKasir(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password-confirm' => 'same:password',
        ]);
        DB::table('kasir') -> where('id_kasir', $request -> id_kasir) -> update([
            'nama_kasir' => $request->name,
            'username_kasir' => $request->username,
            'password_kasir' => Hash::make($request->password),
        ]);
        // Auth::guard('kasir')->login($kasir);
        return redirect()->intended('/datauser');
    }

    public function pesanan()
    {
        return view('pesanan');
    }
}
