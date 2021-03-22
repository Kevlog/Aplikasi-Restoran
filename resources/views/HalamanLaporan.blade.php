@extends('dashboard')
@section('isi')

<!-- Page Header -->
        <div class="page-header row no-gutters py-4 offprint">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Beranda</span>
            <h3 class="page-title">Laporan</h3>
            </div> 
        </div>
            <!-- End Page Header -->
            <!-- Small Stats Blocks -->            

        <div class="container-fluid mt-5 border">  
            <div class="col-md-12 col-sm-12">

                    <div class="col-md mt-4 offprint">
                        <div class="row mt-3">
                            <h5 class="mr-2">Tanggal</h5>
                            <form method="POST" action="/laporan/tanggal">
                                @csrf
                                <input type="date" name="tanggal">
                                <button type="submit" class="btn btn-primary">Lihat</button>                                
                            </form>                            
                            <a onclick="printDiv('tabellaporan')" class="btn btn-md btn-primary text-white ml-auto text-center"><h5 class="text-white fas fa-print"></h5></a>
                            
                        </div>
                    </div>
                    <div id="tabellaporan">
                        <div class="col-md mt-4">
                            <div class="row">
                                <div class="mr-auto col-md-4 text-center">
                                    <h4>Laporan Penjualan</h4> 
                                    <h5 name="lbl-tanggal">{{$tanggal}}</h5> 
                                </div>

                                <div class="card text-center rounded ml-auto col-md-4 shadow-none">                      
                                <div class="card-body bg-secondary">
                                    <h5 class="card-title text-light">Total Pendapatan</h5>
                                    <h5 class="card-text text-white" id="tpendapatan">0</h5>
                                </div>
                                </div>

                                <div class="card text-center rounded ml-auto col-md-4 shadow-none">                     
                                    <div class="card-body bg-secondary">
                                        <h5 class="card-title text-light">Total Penjualan</h4>
                                        <h5 class="card-text text-white" id="tpenjualan">{{$terjual}}</h5>
                                    </div>
                                </div>                    
                            </div>
                        </div>

                        <div class="col-md mt-4">
                            <div class="row">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="laporan">
                                    <thead class="thead-dark">
                                        <tr>             
                                        <th scope="col">No</th>             
                                        <th scope="col">Nama Menu</th>
                                        <th scope="col">Terjual</th>                              
                                        <th scope="col">Harga</th>
                                        <th scope="col">Promo</th>
                                        <th scope="col">Total Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalpendapatan = 0;
                                        @endphp                                                 
                                        @foreach($laporan as $data)
                                        {{-- @foreach($promo as $datapromo) --}}
                                        @php
                                        // dd($promo);
                                            $promo                = $data->harga_menu * $data->jumlah_promo / 100 * $data->total;    
                                            $pendapatan           = $data->harga_menu * $data->total - $promo;    
                                            $totalpendapatan      = $totalpendapatan + $pendapatan;
                                        @endphp     
                                        <tr>                            
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->nama_menu}}</td>
                                            <td>{{$data->total}}</td>                                                                                                    
                                            <td>{{$data->harga_menu}}</td>
                                            @if ($data->jumlah_promo == null)
                                                <td>0</td>
                                                <td>{{$data->harga_menu * $data->total}}</td>                                                
                                            @else
                                            <td>{{$data->harga_menu * $data->jumlah_promo / 100 * $data->total}}</td>                                                                                                    
                                            <td>{{$data->harga_menu * $data->total - $promo}}</td>                                                                                                    
                                            @endif
                                        </tr>                                               
                                        {{-- @endforeach --}}
                                        @endforeach
                                        <input type="text" value="{{$totalpendapatan}}" name="totalpendapatan" id="totalpendapatan" hidden>
                                        <dd></dd>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>   
               
          <script>
            function printDiv(tabellaporan) {
                var disp_setting="toolbar=yes,location=no,";
                disp_setting+="directories=yes,menubar=yes,";
                disp_setting+="scrollbars=yes,width=1280, height=720, left=100, top=25";
                var content_vlue = document.getElementById(tabellaporan).innerHTML;
                var docprint=window.open("","",disp_setting);
                docprint.document.open();
                docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
                docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
                docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');                
                docprint.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />');
                docprint.document.write('<link rel="stylesheet" href="/css/shards-dashboards.1.1.0.css" type="text/css" />');
                docprint.document.write('<link rel="stylesheet" href="/css/extras.1.1.0.min.css" type="text/css" />');                         
                docprint.document.write('</head><body><center>');
                docprint.document.write(content_vlue);
                docprint.document.write('</center></body></html>');
                setTimeout(function(){docprint.print();},2000);
                docprint.document.close();
                docprint.focus();
                docprint.onafterprint = function(){ setTimeout(function () { docprint.close(); }, 1000); }                
            }        

                $(function() {
                    var total = document.getElementById("totalpendapatan").value;
                    console.log(total);
                    document.getElementById("tpendapatan").innerText = 'Rp' + total;                   
                });
          </script>
@endsection