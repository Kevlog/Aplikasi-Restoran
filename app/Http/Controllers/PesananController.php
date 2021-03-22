<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Menu;
use Session;
use PDF;
use Storage;
use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class PesananController extends Controller
{
    public function getPesanan()
    {
        $pesanan = DB::table('pemesanan')->where('status_transaksi', 'pending')->get();
        $riwayat = DB::table('pemesanan')->orderBy('id_pemesanan', 'DESC')->where('status_transaksi', 'selesai')->get();       
        return view('HalamanPesanan', ['pesanan' => $pesanan, 'riwayat' => $riwayat]); 
    }
    
    public function cariPesanan(Request $request)
    {        		
        $cari = $request -> x;       
        
        $pesanan = DB::table('pemesanan')->where('status_transaksi', 'pending')->where('nama_customer','like',"%".$cari."%")->get();             
        $riwayat = DB::table('pemesanan')->orderBy('id_pemesanan', 'DESC')->where('status_transaksi', 'selesai')->get();
        
        return view('HalamanPesanan', ['pesanan' => $pesanan, 'riwayat' => $riwayat]);       
    }

    public function hapuspesanan($id)
    {        
        DB::table('pemesanan')->where('id_pemesanan', $id)->delete();     
        return redirect('/pesanan');
    }

    public function cek()
    {
        $ceks = DB::table('pemesanan')->where('status_transaksi', 'pending')->count();
        // $cek = ($ceks->toArray());               
        return response()->json($ceks);
    }

    public static function DataPesanan($id)
    {
                $dx = DB::table('keranjang')
                ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                ->leftjoin('promo', 'keranjang.id_menu', '=', 'promo.id_menu')
                ->select('keranjang.*', 'menu.*', 'promo.jumlah_promo')
                ->where('keranjang.id_session', '=', $sid)                    
                ->get(); 
                return (['dx' => $dx]);
    }

    public function proses(request $request, $id)
    {
        DB::table('pemesanan')->where('id_pemesanan', $id)->update([            
            'uang_bayar' => $request->dibayar,
            'uang_kembali' => $request->kembalian,     
            'status_transaksi' => 'selesai'             
        ]);
             
        return redirect('/pesanan');
    }

    public function prints($id)
    {
        $kertas = array(0,0,600,550);
        $pdf = PDF::loadView('invoice.print', compact('id'))->setPaper($kertas, 'landscape');
        $path = public_path('invoice/');
        $fileName =  $id . '.' . 'pdf' ;
        $pdf->save($path . '/' . $fileName);
        header("Content-type: application/pdf");        
        // return response()->download($path . $fileName, 'example.pdf', [], 'inline');
        return $pdf->stream("invoice", array("Attachment" => false));  
    }
    
}
