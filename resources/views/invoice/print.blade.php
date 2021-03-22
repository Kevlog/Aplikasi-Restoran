<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="application/pdf"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:14px;
            margin:0;
        }
        .container{
            margin-left:-15;            
            /* padding:40px; */
            width:200px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:14px;
            margin-bottom:12px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:200px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:150px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>    
</head>
@php
        $riwayat = DB::table('keranjang')
                ->join('pemesanan', 'keranjang.id_session', '=', 'pemesanan.id_session')
                ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                ->leftjoin('promo', 'keranjang.id_menu', '=', 'promo.id_menu')
                ->select('keranjang.*', 'menu.*', 'promo.jumlah_promo', 'pemesanan.*')                
                ->where('pemesanan.id_pemesanan', $id)                    
                ->get(); 
                // dd($riwayat);
                    $invoice = $riwayat[0];
                    $tanggal = Carbon\Carbon::parse($riwayat[0]->tanggal)->translatedFormat('d F Y');
                    $total = 0;
                    $totalfix = $riwayat[0]->total_harga;  
@endphp
<body>
    <div class="container">
        <table>
            <caption>          
            </caption>
            <thead>
                <tr>
                    <th colspan="2">Transaksi <strong>#{{ $riwayat[0]->id_pemesanan }}</strong></th>
                    <th colspan="2">{{ $tanggal }}</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Perusahaan: </h4>                       
                            Restoran<br>
                            089123123123<br>
                            
                        </p>
                    </td>
                    <td colspan="2">
                        <h4>Pelanggan: </h4>
                        <p>{{ $invoice->nama_customer }}<br>                        
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                @foreach ($riwayat as $row)
                <tr>
                    <td>{{ $row->nama_menu }}</td>
                    <td>Rp {{ number_format($row->harga_menu) }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>Rp {{ number_format($row->harga_menu * $row->jumlah) }}</td>
                    @php
                        $subtotal = $row->harga_menu * $row->jumlah;
                        $total = $total + $subtotal;
                    @endphp
                </tr>
                @endforeach
                @foreach ($riwayat as $row)
                    @if ($row->jumlah_promo != null)
                    <tr>
                        <th colspan="2">Diskon</th>
                        <td colspan="2">Rp {{ number_format(($row->jumlah_promo * $row->harga_menu / 100)) }}</td>
                    </tr>
                    @endif
                @endforeach
            </thead>            
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <td colspan="2">Rp {{ number_format(($totalfix)) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>