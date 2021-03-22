<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LaporanController extends Controller
{
    public function getLaporan(Request $request)
    {        
        $terjual = DB::table('keranjang')
                    ->leftjoin('pemesanan', 'keranjang.id_session', '=', 'pemesanan.id_session')
                    ->where('pemesanan.tanggal', '<=', date('Y-m-d')) 
                    ->value(DB::Raw('SUM(keranjang.jumlah) AS terjual'));
        $laporan = DB::table('pemesanan')
                    ->join('keranjang', 'pemesanan.id_session', '=', 'keranjang.id_session')
                    ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('keranjang.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                          
                    })               
                    ->select('promo.*','keranjang.*', 'menu.*', DB::raw('SUM(keranjang.jumlah) AS total'))
                    ->where('pemesanan.status_transaksi', 'selesai')
                    ->groupBy('menu.id_menu')                         
                    ->get();                
        $tanggal = Carbon::now()->translatedFormat('d F Y');
        // dd($laporan);                   
        return view('HalamanLaporan', ['laporan' => $laporan, 'terjual' => $terjual, 'tanggal' => $tanggal]);        
    }

    public function tanggal(Request $request)
    {        
        $terjual = DB::table('keranjang')
                    ->leftjoin('pemesanan', 'keranjang.id_session', '=', 'pemesanan.id_session')
                    ->where('pemesanan.tanggal', '<=', $request->tanggal) 
                    ->value(DB::Raw('SUM(keranjang.jumlah) AS terjual'));
        $laporan = DB::table('pemesanan')
                    ->join('keranjang', 'pemesanan.id_session', '=', 'keranjang.id_session')
                    ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('keranjang.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                          
                    })               
                    ->select('promo.*','keranjang.*', 'menu.*', DB::raw('SUM(keranjang.jumlah) AS total'))  
                    ->where('pemesanan.tanggal', '<=', $request->tanggal) 
                    ->where('pemesanan.status_transaksi', 'selesai')
                    ->groupBy('menu.id_menu')                         
                    ->get();                     
        $tanggal = Carbon::parse($request->tanggal)->translatedFormat('d F Y');
                        
        return view('HalamanLaporan', ['laporan' => $laporan, 'terjual' => $terjual, 'tanggal' => $tanggal]);        
    }
}
