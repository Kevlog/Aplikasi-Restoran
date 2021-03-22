<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Menu;
use Session;

class PemesananCustomer extends Controller
{
    public function daftarmenu(Request $request)
    {
        $sid = session()->getId();
    
        $menu = DB::table('menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('menu.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                            
                    })
                    ->leftjoin('rating_review', 'menu.id_menu', '=', 'rating_review.id_menu')
                    ->select('menu.*', 'promo.*', 'menu.id_menu as id_menu', 'menu.deskripsi as deskripsi','promo.deskripsi as deskripsipromo', 'promo.id_menu as idmenupromo', 'rating_review.review', DB::raw('AVG(rating_review.rating) AS rating'))                    
                    ->groupBy('menu.id_menu')              
                    ->get();                            
    
        return view('HalamanDataMenuRestoran', ['menu' => $menu, 'sid' => $sid]);        
    }

    public function sortharga(Request $request)
    {
        $sid = session()->getId();
        
        $menu = DB::table('menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('menu.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                            
                    })
                    ->leftjoin('rating_review', 'menu.id_menu', '=', 'rating_review.id_menu')
                    ->select('menu.*', 'promo.*', 'menu.id_menu as id_menu', 'menu.deskripsi as deskripsi','promo.deskripsi as deskripsipromo', 'promo.id_menu as idmenupromo', 'rating_review.review', DB::raw('AVG(rating_review.rating) AS rating'))                    
                    ->groupBy('menu.id_menu')
                    ->orderBy('menu.harga_menu', 'asc')                                                            
                    ->get();        
            
        return view('HalamanDataMenuRestoran', ['menu' => $menu, 'sid' => $sid]);        
    }

    public function sortrating(Request $request)
    {
        $sid = session()->getId();
        
        $menu = DB::table('menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('menu.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                            
                    })
                    ->leftjoin('rating_review', 'menu.id_menu', '=', 'rating_review.id_menu')
                    ->select('menu.*', 'promo.*', 'menu.id_menu as id_menu', 'menu.deskripsi as deskripsi','promo.deskripsi as deskripsipromo', 'promo.id_menu as idmenupromo', 'rating_review.review', DB::raw('AVG(rating_review.rating) AS rating'))                    
                    ->groupBy('menu.id_menu')
                    ->orderBy('rating', 'desc')                                                            
                    ->get();        
            
        return view('HalamanDataMenuRestoran', ['menu' => $menu, 'sid' => $sid]);        
    }

    public function ismakanan(Request $request)
    {
        $sid = session()->getId();
        
        $menu = DB::table('menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('menu.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                            
                    })
                    ->leftjoin('rating_review', 'menu.id_menu', '=', 'rating_review.id_menu')
                    ->select('menu.*', 'promo.*', 'menu.id_menu as id_menu', 'menu.deskripsi as deskripsi','promo.deskripsi as deskripsipromo', 'promo.id_menu as idmenupromo', 'rating_review.review', DB::raw('AVG(rating_review.rating) AS rating'))                    
                    ->groupBy('menu.id_menu')
                    ->where('menu.jenis_menu', 'makanan')                                                            
                    ->get();        
            
        return view('HalamanDataMenuRestoran', ['menu' => $menu, 'sid' => $sid]);        
    }

    public function isminuman(Request $request)
    {
        $sid = session()->getId();
        
        $menu = DB::table('menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('menu.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                            
                    })
                    ->leftjoin('rating_review', 'menu.id_menu', '=', 'rating_review.id_menu')
                    ->select('menu.*', 'promo.*', 'menu.id_menu as id_menu', 'menu.deskripsi as deskripsi','promo.deskripsi as deskripsipromo', 'promo.id_menu as idmenupromo', 'rating_review.review', DB::raw('AVG(rating_review.rating) AS rating'))                    
                    ->groupBy('menu.id_menu')
                    ->where('menu.jenis_menu', 'minuman')                                                                                                                     
                    ->get();        
            
        return view('HalamanDataMenuRestoran', ['menu' => $menu, 'sid' => $sid]);        
    }

    public function getPromo(Request $request)
    {
        $sid = session()->getId();
        
        $menu = DB::table('menu')
                    ->join('promo', 'menu.id_menu', '=', 'promo.id_menu')
                    ->leftjoin('rating_review', 'menu.id_menu', '=', 'rating_review.id_menu')
                    ->select('menu.*', 'promo.*', 'menu.id_menu as id_menu', 'menu.deskripsi as deskripsi','promo.deskripsi as deskripsipromo', 'promo.id_menu as idmenupromo', 'rating_review.review', DB::raw('AVG(rating_review.rating) AS rating'))                    
                    ->where('promo.end' ,'>=', date('Y-m-d'))
                    ->groupBy('menu.id_menu')                                                            
                    ->get();        
            
        return view('HalamanDataMenuRestoran', ['menu' => $menu, 'sid' => $sid]);        
    }

    public function cari(Request $request)
    {        		
        $sid = session()->getId();
        $cari = $request -> x;

        $menu = DB::table('menu')
                    ->leftJoin('promo', function($join)
                    {
                        $join->on('menu.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                            
                    })
                    ->leftjoin('rating_review', 'menu.id_menu', '=', 'rating_review.id_menu')
                    ->select('menu.*', 'promo.*', 'menu.id_menu as id_menu', 'menu.deskripsi as deskripsi','promo.deskripsi as deskripsipromo', 'promo.id_menu as idmenupromo', 'rating_review.review', DB::raw('AVG(rating_review.rating) AS rating'))                    
                    ->groupBy('menu.id_menu')                                   
                    ->where('nama_menu','like',"%".$cari."%")                                                            
                    ->get();        
      
        return view('HalamanDataMenuRestoran',['menu' => $menu,  'sid' => $sid]);
    }

    public function setPesanan(Request $request, $id)
    {        
        $sid = session()->getId();
         
        $cek = DB::table('keranjang')->where('id_menu', $id)->where('id_session', $sid)->first();
        if ($cek == null) {                      
            DB::table('keranjang')-> insert([
                'id_menu' => $id,
                'jumlah' => '1',
                'id_session' => $sid,
                'cek' => '0',                  
            ]);
            
            return redirect('/');
        }
        else {
            DB::table('keranjang')->where('id_session', $sid)->where('id_menu', $id)->update(['jumlah' => $request->jumlah]);
            return redirect('/');
        }
    }

    public function tambahjumlah(request $request)
    {
        $sid = session()->getId();
        $stok = DB::table('menu')->where('id_menu', $request->id)->value('jumlah_stok');
        $updatestok = $stok - $request->jumlah; 
        DB::table('keranjang')->where('id_session', $sid)->where('id_menu', $request->id)->update(['jumlah' => $request->jumlah]);
        DB::table('menu')->where('id_menu', $request->id)->update(['jumlah_stok' => $updatestok]);
        return redirect('/keranjang');
    }

    public function keranjang(Request $request)
    {
        $sid = session()->getId();

        $cek = DB::table('keranjang')->where('id_session', $sid)->first();
        $keranjang = DB::table('keranjang')
                    ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')                    
                    ->leftJoin('promo', function($join)
                         {
                             $join->on('keranjang.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                            
                         })
                    ->select('keranjang.*', 'menu.*', 'promo.*', 'menu.id_menu as id_menu')
                    ->where('keranjang.id_session', '=', $sid)                                        
                    ->get();

            if($cek != null) {
                return view('keranjang', ['keranjang' => $keranjang]);        
            }
            else {
                return redirect('/');
            }                
    }

    public function hapus($id)
    {        
        $sid = session()->getId();
        DB::table('keranjang')->where('id_menu', $id)->where('id_session', $sid)->delete();     
        return redirect('/');
    }

    public function chapus($id)
    {        
        $sid = session()->getId();
        DB::table('keranjang')->where('id_menu', $id)->where('id_session', $sid)->delete();     
        return redirect('/keranjang');
    }

    public function selesai(Request $request)
    {        
        $validatedData = $request->validate([
            'nama_customer' => 'required|max:30',
            'nomer_meja' => 'required',
            'total' => 'required',            
        ]);

        $sid = session()->getId();        
        DB::table('pemesanan')-> insert([
            'id_session' => $sid,
            'nama_customer' => $request -> nama_customer,
            'nomer_meja' => $request -> nomer_meja,
            'total_harga' => $request -> total,
            'tanggal' => date('Y-m-d'),
            'uang_bayar' => '0',
            'uang_kembali' => '0',     
            'status_transaksi' => 'pending'             
        ]);
       
        return redirect('/ulasan');
    }

    public function ulasan(Request $request)
    {
        $sid = session()->getId();

        $cek = DB::table('keranjang')->where('id_session', $sid)->where('cek', '0')->first();
        $menu = DB::table('keranjang')
                    ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                    ->select('keranjang.*', 'menu.*')
                    ->where('keranjang.id_session', '=', $sid)
                    ->where('cek', '=', '0')                   
                    ->get();        
        
            if($cek != null) {
                return view('rr', ['menu' => $menu]);        
            }
            else {
                $request->session()->regenerate();
                return redirect('/');
            }
        
    }

    public function reset(request $request)
    {
        $request->session()->regenerate();
        return redirect('/');
    }
}
