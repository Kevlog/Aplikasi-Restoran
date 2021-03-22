@extends('dashboard')
@section('isi')

<!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Beranda</span>
                <h3 class="page-title">Pesanan</h3>
              </div> 
            </div>
            <!-- End Page Header -->
            <!-- Small Stats Blocks -->
            <div class="row pb-5">              
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card">
                    
                    <div class="card-header bg-dark text-white">
                        <div class="row">
                        <h5 class="text-white col-md">Pesanan Terbaru</h5>
                            <form action="/pesanan/cari" method="POST" class="ml-auto col-md-6">
                              @csrf
                              <input type="text" class="form-control transparent-input col-md-12 text-white" name="x" placeholder="" >
                              <input type="submit" style="position: absolute; left: -9999px"/>
                            </form>
                        </div>
                    </div>
                        
                    <div class="card-body">
                    <!-- isi pesanan -->
                        @foreach ($pesanan as $data)             
                        <div class="card card-md bg-secondary mb-3 mt-3">
                            <div class="card-body pb-2 pt-2">                                
                                <div class="col-md-12">
                                    <div class="row">
                                        <h5 class="text-white">Nama : <a>{{$data->nama_customer}}</a></h5>
                                        <button class="btn btn-success col-md-2 ml-auto" name="btn-proses" data-toggle="modal" data-target="#proses{{$data->id_pemesanan}}" data-backdrop="static" data-keyboard="false">Proses</button>
                                    </div>
                                    <!-- <div class="d-flex justify-content-center">
                                        <span class="text-white">Rp 4.982.000</span>  
                                    </div> -->
                                    <div class="row">
                                        <h5 class="text-white text-lg">No. Meja : <a>{{$data->nomer_meja}}</a></h5>
                                    <a class="btn btn-danger col-md-2 ml-auto mt-2" name="btn-hapus" href="/pesanan/hapus/{{$data->id_pemesanan}}">Hapus</a>
                                    </div>                                                                                                          
                                </div>                                                                                              
                            </div>
                        </div>
                        
                        <div class="modal fade" id="proses{{$data->id_pemesanan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark">
                                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Transaksi Pembayaran ({{$data->nama_customer}})</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body container-fluid table-responsive">
                                        <table class="table  table-bordered text-center" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>                          
                                            <th scope="col">No.</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                                $id = $data->id_session;
                                                $dx = DB::table('keranjang')
                                                ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                                                ->leftJoin('promo', function($join)
                                                    {
                                                        $join->on('keranjang.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                          
                                                    })   
                                                ->select('keranjang.*', 'menu.*', 'promo.jumlah_promo')
                                                ->where('keranjang.id_session', '=', $id)                    
                                                ->get(); 
                                            @endphp                                                                        
                                            @foreach($dx as $datas)
                                            @php
                                                $hargafix    = $datas->harga_menu - ($datas->harga_menu * $datas->jumlah_promo / 100);
                                                $subtotal    = $hargafix * $datas->jumlah;    
                                                $total       = $total + $subtotal;                           
                                            @endphp     
                                            <tr>                            
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$datas->nama_menu}}</td>
                                                <td>{{$datas->jumlah}}</td> 
                                                <td>{{$subtotal}}</td>                                                                
                                                <td><a class="btn btn-danger text-white" href="/keranjang/chapus/{{$datas->id_menu}}"><i class="material-icons">delete</i></a></td> 
                                            </tr>
                                            @endforeach
                                            <tr>                            
                                                <td colspan="4">Total</td>
                                            <td>{{$total}}</td>                                                                                            
                                            </tr>
                                            <tr>                            
                                                <td colspan="4">No. Meja</td>
                                                <td>{{$data->nomer_meja}}</td>                                                                                            
                                            </tr>
                                        </tbody>
                                        </table>
                                        <form action="/pesanan/proses/{{$data->id_pemesanan}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Uang yang dibayarkan</label>
                                                <input type="text" hidden class="form-control" id="total{{$data->id_pemesanan}}" onkeyup="sum{{$data->id_pemesanan}}();" placeholder="Total yang Dibayarkan" value="{{$total}}">
                                                <input type="text" class="form-control" name="dibayar" id="dibayar{{$data->id_pemesanan}}" onkeyup="sum{{$data->id_pemesanan}}();" placeholder="Total yang Dibayarkan">                                    
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Total Kembalian</label>
                                                <input type="text" class="form-control" name="kembalian" id="kembalian{{$data->id_pemesanan}}" onkeyup="sum{{$data->id_pemesanan}}();" placeholder="Total Kembalian">
                                            </div>                                                                                          
                                    </div>
                                    <div class="modal-footer">                            
                                        <button type="submit" class="btn btn-success" name="btn-selesai" id="selesai"><i class="material-icons">check</i> Transaksi Selesai</button>
                                    </form>
                                        <button type="button" class="btn btn-danger" name="btn-batal" data-dismiss="modal"><i class="material-icons"></i> Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function sum{{$data->id_pemesanan}}() {
                                var total = document.getElementById('total{{$data->id_pemesanan}}').value;
                                var bayar = document.getElementById('dibayar{{$data->id_pemesanan}}').value;
                                var result = parseFloat(bayar) - parseFloat(total);
                                if (result < 0) { 
                                    document.getElementById('kembalian{{$data->id_pemesanan}}').value = result;
                                    document.getElementById('selesai').disabled = true; 
                                }
                                else if (result > 0) {
                                    document.getElementById('kembalian{{$data->id_pemesanan}}').value = result;
                                    document.getElementById('selesai').disabled = false; 
                                }
                            } 
                        </script>
                        @endforeach                     
                    </div>
                    <!-- isi pesanan -->
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card">
                    <h5 class="card-header bg-dark text-white">Riwayat Pesanan</h5>                       
                    <div class="card-body">                                                       
                    @foreach ($riwayat as $data)
                        <div class="card card-sm bg-secondary mb-3 mt-3">
                            <div class="card-body pb-2 pt-2">                                
                                <div class="col-md-12">
                                    <div class="row">
                                        <h5 class="text-white">Nama : <a>{{$data->nama_customer}}</a></h5>
                                        <input type="hidden" id="namacetak{{$data->id_pemesanan}}" value="{{$data->nama_customer}}">
                                        <button class="btn btn-success col-md-2 ml-auto" name="btn-cetak" data-toggle="modal" data-target="#cetak{{$data->id_pemesanan}}" data-backdrop="static" data-keyboard="false">Cetak</button>
                                    </div>                                   
                                    <div class="row">
                                        <h5 class="text-white text-lg">No. Meja : <a>{{$data->nomer_meja}}</a></h5>
                                        <a class="btn btn-danger col-md-2 ml-auto mt-2" href="/pesanan/hapus/{{$data->id_pemesanan}}">Hapus</a>
                                    </div>                                                                                                          
                                </div>                                                                                              
                            </div>
                            <div class="modal fade" id="cetak{{$data->id_pemesanan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Transaksi Pembayaran ({{$data->nama_customer}})</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body container-fluid" id="cetak">
                                            <table class="table table-bordered text-center" id="myTable">
                                            <thead class="thead-dark">
                                                <tr>                          
                                                <th scope="col">No.</th>
                                                <th scope="col">Menu</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total = 0;
                                                    $id = $data->id_session;
                                                    $dxx = DB::table('keranjang')
                                                    ->join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                                                    ->leftJoin('promo', function($join)
                                                    {
                                                        $join->on('keranjang.id_menu', '=', 'promo.id_menu')->where('promo.end','>=',date('Y-m-d'));                          
                                                    })   
                                                    ->select('keranjang.*', 'menu.*', 'promo.jumlah_promo', 'promo.*')
                                                    ->where('keranjang.id_session', '=', $id)                    
                                                    ->get(); 
                                                @endphp                                                                        
                                                @foreach($dxx as $datas)
                                                @php
                                                    $hargafix    = $datas->harga_menu;
                                                    if ($datas->end >= date('y-m-d') ) {
                                                        $hargafix    = $datas->harga_menu - ($datas->harga_menu * $datas->jumlah_promo / 100);
                                                    }  
                                                    $subtotal    = $hargafix * $datas->jumlah;    
                                                    $total       = $total + $subtotal;                           
                                                @endphp     
                                                <tr>                            
                                                    <td>{{$loop->iteration}}</td>
                                                    <td class="datamenu{{$data->id_pemesanan}}">{{$datas->nama_menu}}</td>
                                                    <td class="datajumlah{{$data->id_pemesanan}}">{{$datas->jumlah}}</td> 
                                                    <td class="dataharga{{$data->id_pemesanan}}">{{$subtotal}}</td>                                                                                                                    
                                                </tr>
                                                @endforeach
                                                <tr>                            
                                                    <td colspan="3">Total</td>
                                                <td class="datatotal{{$data->id_pemesanan}}">{{$total}}</td>                                                                                            
                                                </tr>
                                                <tr>                            
                                                    <td colspan="3">No. Meja</td>
                                                    <td class="datameja{{$data->id_pemesanan}}">{{$data->nomer_meja}}</td>                                                                                            
                                                </tr>
                                            </tbody>
                                            </table>
                                            <form action="/pesanan/proses/{{$data->id_pemesanan}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Uang yang dibayarkan</label>
                                                    <input type="text" hidden class="form-control" id="total{{$data->id_pemesanan}}" onkeyup="sum{{$data->id_pemesanan}}();" placeholder="Total yang Dibayarkan" value="{{$total}}">
                                                    <input type="text" class="form-control" name="dibayar" id="dibayar{{$data->id_pemesanan}}" value="{{$data->uang_bayar}}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Total Kembalian</label>
                                                <input type="text" class="form-control" name="kembalian" id="kembalian{{$data->id_pemesanan}}" value="{{$data->uang_kembali}}" readonly>
                                                </div>                                                                                          
                                        </div>
                                        <div class="modal-footer">                            
                                        <button type="button" class="btn btn-success" name="btn-selesai" onclick="cetak{{$data->id_pemesanan}}('cetak')"><i class="material-icons">print</i><a class="text-white"> Cetak</a></button>
                                        {{-- <button type="submit" class="btn btn-success" name="btn-selesai"><i class="material-icons">print</i><a class="text-white" href="/pesanan/print/{{$data->id_pemesanan}}" target="_blank"> Cetak</a></button> --}}
                                        </form>
                                            <button type="button" class="btn btn-danger" name="btn-batal" data-dismiss="modal"><i class="material-icons"></i> Batal</button>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $dxx
                                @endphp
                                <script>
                                    function cetak{{$data->id_pemesanan}}(cetak) {
                                        var disp_setting="toolbar=yes,location=no,";
                                        disp_setting+="directories=yes,menubar=yes,";
                                        disp_setting+="scrollbars=yes,width=360, height=720";                                                                                                               
                                        var nota=window.open("","",disp_setting);                                        
                                        var menu = document.querySelectorAll('.datamenu{{$data->id_pemesanan}}');
                                        var jumlah = document.querySelectorAll('.datajumlah{{$data->id_pemesanan}}');
                                        var harga = document.querySelectorAll('.dataharga{{$data->id_pemesanan}}');
                                        var total = document.querySelectorAll('.datatotal{{$data->id_pemesanan}}');
                                        var meja = document.querySelectorAll('.datameja{{$data->id_pemesanan}}');
                                        var nama = document.getElementById('namacetak{{$data->id_pemesanan}}').value;                                            
                                        var bayar = document.getElementById('dibayar{{$data->id_pemesanan}}').value;                                            
                                        var kembali = document.getElementById('kembalian{{$data->id_pemesanan}}').value;                                            
                                        // console.log(Object.keys(menu).length);
                                        // console.log(total[0].innerHTML);
                                        // console.log(meja[0].innerHTML);
                                        nota.document.open();                                        
                                        nota.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
                                        nota.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
                                        nota.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
                                        // nota.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />');
                                        nota.document.write('</head><body style="width=155px;max-width:155px;font-size:12px;font-family:Times New Roman;"><center>');
                                        nota.document.write('<b><h3>RESTORAN</h3></b><br>');
                                        nota.document.write('<a>www.rajafana.online</a><br>');
                                        nota.document.write('<a>Gedung Unesa A10 Ketintang, Surabaya</a><br>');
                                        nota.document.write('</center><br>');
                                        nota.document.write('<a>=======================<br>');
                                        nota.document.write('<a>ID Transaksi :\xa0TRX'+ {{$data->id_pemesanan}} + '</a><br>');
                                        nota.document.write('<a>Nama \xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0: ' + nama + '</a><br>');
                                        nota.document.write('<a>No. Meja \xa0\xa0\xa0\xa0\xa0\xa0: ' + meja[0].innerHTML + '</a><br>');
                                        nota.document.write('<a>=======================<br>');
                                        nota.document.write('<a>Menu</a><a style="float:right;">Harga</a><br>');                                        
                                        nota.document.write('<a>=======================<br>');
                                        for (var i = 0, len = Object.keys(menu).length; i < len; i++) {
                                            // nota.document.write(menu[i].outerHTML);
                                            nota.document.write(jumlah[i].outerHTML + ' * ' + menu[i].outerHTML + '<a style="float:right;">' + harga[i].outerHTML + '</a><br>');  
                                        }
                                        nota.document.write('<a>=======================<br>');                  
                                        nota.document.write('<a>Total</a><a style="float:right;">' + total[0].innerHTML + '</a><br>');                                    
                                        nota.document.write('<a>Bayar</a><a style="float:right;">' + bayar + '</a><br>');                                    
                                        nota.document.write('<a>Kembali</a><a style="float:right;">' + kembali + '</a><br>');                                    
                                        nota.document.write('<center><b><h3>Terima Kasih</h3></b><br>');
                                        nota.document.write('<a>Harga Sudah Termasuk PPN</a><br>');
                                        nota.document.write('<a>Semoga Hari Anda Menyenangkan</a><br>');
                                        nota.document.write('</center><br>');                                                                                                                                                                                                                                             
                                        nota.document.write('</body></html>');
                                        setTimeout(function(){nota.print();},2000);
                                        nota.document.close();
                                        nota.focus();                                        
                                        nota.onafterprint = function(){ setTimeout(function () { nota.close(); }, 1000); }                
                                    }     
                                </script>
                        </div> 
                        @endforeach                   
                    </div>
                    
                    <!-- isi pesanan -->
                </div>
              </div>

            </div>            
            
    <script>                         

    function ceks(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/pesanan/cek',
            type: 'POST',
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            success: function (data) {
            $("#jumlah_pesanan").text(""+data+"");            
            timer = setTimeout("ceks()",5000);
            }
        });  
    }
    $(document).ready(function(){
        ceks();
    });    
    </script>

@endsection