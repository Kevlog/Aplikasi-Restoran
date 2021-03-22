<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Menu;

class MenuController extends Controller
{    
    public function getMenuRestoran()
    {        
        $menu = DB::table('menu')->get();
        $jumlahmenu = DB::table('menu')->count();
        $menuterbaru = DB::table('menu')->latest('nama_menu')->value('nama_menu');        
        
        return view('HalamanMenuRestoran', ['menu' => $menu, 'jumlahmenu' => $jumlahmenu, 'menuterbaru' => $menuterbaru]);        
    }
    
    public function setDataMenuRestoran(Request $request)
    {
        $validatedData = $request->validate([
            'nama_menu' => 'required|max:255',
            'deskripsi' => 'required',
            'harga_menu' => 'required',
            'jumlah_stok' => 'required',
            'jenis_menu' => 'required',
        ]);

        $file       = $request->file('gambar');
        $fileName   = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move("images/", $fileName);

        DB::table('menu')-> insert([
            'nama_menu' => $request -> nama_menu,
            'deskripsi' => $request -> deskripsi,
            'gambar' => $fileName,
            'jumlah_stok' => $request -> jumlah_stok,
            'harga_menu' => $request -> harga_menu,
            'jenis_menu' => $request -> jenis_menu,           
        ]);
        
        return redirect('/menu') -> with('status', 'Data Menu Berhasil Ditambahkan');
    }

    public function cari(Request $request)
    {        		
        $cari = $request -> x;       
        
        $menu = DB::table('menu')->where('nama_menu','like',"%".$cari."%")->get();             
        $jumlahmenu = DB::table('menu')->count();
        $menuterbaru = DB::table('menu')->latest('nama_menu')->value('nama_menu');        
        
        return view('HalamanMenuRestoran', ['menu' => $menu, 'jumlahmenu' => $jumlahmenu, 'menuterbaru' => $menuterbaru]);        
    }
    
    public function update(Request $request)
    {
        {
            $validatedData = $request->validate([
                'nama_menu' => 'required|max:255',
                'deskripsi' => 'required',
                'harga_menu' => 'required',
                'jumlah_stok' => 'required',
                'jenis_menu' => 'required',
            ]);
                        
            if ($request->file('gambar') != null) {
            $file       = $request->file('gambar');
            $fileName   = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move("images/", $fileName);
            }

            else {
                $fileName   = DB::table('menu') -> where('id_menu', $request -> id_menu) -> value('gambar');
            }
    
            DB::table('menu') -> where('id_menu', $request -> id_menu) -> update([
                'nama_menu' => $request -> nama_menu,
                'deskripsi' => $request -> deskripsi,
                'gambar' => $fileName,
                'jumlah_stok' => $request -> jumlah_stok,
                'harga_menu' => $request -> harga_menu,
                'jenis_menu' => $request -> jenis_menu,              
            ]);
            
            return redirect('/menu') -> with('status', 'Data Menu Berhasil Ditambahkan');
        }
    
    }

    public function hapus($id)
    {
        DB::table('menu')->where('id_menu', $id)->delete();     
        return redirect('/menu')-> with('status', 'Data Berhasil DiHapus');
    }
}
