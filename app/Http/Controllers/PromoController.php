<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Menu;
use Promo;
use DB;

class PromoController extends Controller
{
    public function getPromo()
    {
        // mengambil data dari table books
        $menu = DB::table('menu')->get();        
        $promo = DB::table('promo')
                    ->join('menu', 'promo.id_menu', '=', 'menu.id_menu')
                    ->select('promo.*', 'menu.*')
                    ->where('end', '>=', Carbon::today())                                      
                    ->get();
        $terbaru = DB::table('promo')->orderBy('id_promo', 'DESC')->value('nama_promo');               
        $jumlah = DB::table('promo')->count();
        $jumlahbulanini = DB::table('promo')->where('end', '>=', Carbon::today())->count();
        $aktif = DB::table('promo')->where('end', '>=', Carbon::today())->count();
        // mengirim data books ke view books
        return view('HalamanPromo', ['menu' => $menu, 'promo' => $promo, 'terbaru' => $terbaru, 'jumlah' => $jumlah, 'jumlahbulanini' => $jumlahbulanini, 'aktif' => $aktif]);
    }

    public function getRiwayatPromo()
    {
        // mengambil data dari table books
        $menu = DB::table('menu')->get();        
        $promo = DB::table('promo')
                    ->join('menu', 'promo.id_menu', '=', 'menu.id_menu')
                    ->select('promo.*', 'menu.*')
                    ->where('end', '<=', Carbon::today())                                      
                    ->get();
        $terbaru = DB::table('promo')->orderBy('id_promo', 'DESC')->value('nama_promo');               
        $jumlah = DB::table('promo')->count();
        $jumlahbulanini = DB::table('promo')->where('end', '>=', Carbon::today())->count();
        $aktif = DB::table('promo')->where('end', '>=', Carbon::today())->count();
        // mengirim data books ke view books
        return view('HalamanPromo', ['menu' => $menu, 'promo' => $promo, 'terbaru' => $terbaru, 'jumlah' => $jumlah, 'jumlahbulanini' => $jumlahbulanini, 'aktif' => $aktif]);
    }

    public function dataharga(Request $request)
    {
        $harga = DB::table('menu')->where('id_menu', $request->id)->value('harga_menu');
        return response()->json($harga);
    }

    public function setDataPromo(Request $request)
    {
        $validatedData = $request->validate([
            'id_menu' => 'required',
            'nama_promo' => 'required',
            'deskripsi' => 'required',
            'start' => 'required',
            'end' => 'required',
            'jumlah_promo' => 'required',
        ]);

        DB::table('promo')-> insert([
            'nama_promo' => $request -> nama_promo,
            'id_menu' => $request -> id_menu,
            'deskripsi' => $request -> deskripsi,
            'start' => $request -> start,
            'end' => $request -> end,           
            'jumlah_promo' => $request -> jumlah_promo,           
        ]);
        // alihkan halaman tambah buku ke halaman books
        return redirect('/promo') -> with('status', 'Data Menu Berhasil Ditambahkan');
    }

    public function update(Request $request)
    {
        {
            $validatedData = $request->validate([                
                'nama_promo' => 'required',
                'deskripsi' => 'required',
                'start' => 'required',
                'end' => 'required',
                'jumlah_promo' => 'required',
            ]);
                                    
            DB::table('promo') -> where('id_promo', $request -> id_promo) -> update([
                'nama_promo' => $request -> nama_promo,                
                'deskripsi' => $request -> deskripsi,
                'start' => $request -> start,
                'end' => $request -> end,           
                'jumlah_promo' => $request -> jumlah_promo,           
            ]);
            // alihkan halaman tambah buku ke halaman books
            return redirect('/promo') -> with('status', 'Data Menu Berhasil Diupdate');
        }
    
    }

    public function hapus($id)
    {
        DB::table('promo')->where('id_promo', $id)->delete();     
        return redirect('/promo')-> with('status', 'Data Berhasil DiHapus');
    }
}
