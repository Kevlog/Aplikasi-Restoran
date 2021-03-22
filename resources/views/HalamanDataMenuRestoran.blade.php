@extends('header')

@section('content')
    <body style="max-width: 425px; margin: 0 auto !important; float: none !important;">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand text-white mr-auto ml-auto d-block" href="#"><h3 class="text-white">Restoran</h3></a>
        </nav>
        <hr>
        @php
            $cek1 = DB::table('keranjang')->where('id_session', $sid)->first();       
        @endphp
        <div class="" id="keranjang">
            @if ($cek1 == null)
            <a class="btn btn-lg btn-secondary text-white keranjang mx-auto fixed-bottom mb-5 disabled" href="/keranjang" ><i class="material-icons">add_shopping_cart</i> Keranjang kosong</a> 
            @else
            <a class="btn btn-lg btn-primary text-white keranjang mx-auto fixed-bottom mb-5" href="/keranjang"><i class="material-icons">add_shopping_cart</i> Keranjang</a> 
            @endif
            
        </div>
        <div class="col-md-12">            
            <a class="btn btn-lg btn-dark text-white col-md" href="/" name="btn-semua"><i class="material-icons">all_inbox</i> Semua</a>
            <a class="btn btn-lg btn-dark text-white col-md mt-2 mb-2" href="/daftarpromo" name="btn-promo"><i class="material-icons">local_offer</i> Promo</a>
            <div class="col-md-12 text-center">
                <a class="btn btn-lg btn-dark text-white mt-2 mb-2" href="/makanan" name="btn-makanan"><i class="material-icons">local_dining</i> Makanan</a>
                <a class="btn btn-lg btn-dark text-white mt-2 mb-2" href="/minuman" name="btn-minuman"><i class="material-icons">local_drink</i> Minuman</a>
            </div>
            <div class="mt-2 form-group col-md-12 text-center d-block">
                <select id=sorting name ="sorting" class="form-control">
                    <optgroup>
                    <option selected="selected" class="text-lg">Urutkan Berdasarkan</option>
                        <option class="service-small" value="/sortharga">Harga Normal</option>                        
                        <option class="service-small" value="/sortrating">Rating</option> 
                    </optgroup>                    
                </select>               
                <a onclick="sorting()" id="terapkan" class="btn btn-success col-md text-white" name="btn-terapkan">Terapkan</a>
                <script>
                    function sorting() {
                        var url = document.getElementById("sorting").value;
                        window.location.replace(url);
                    }
                </script>
            </div>
            <div class="md-form col-md-12 mt-0">
                <form action="/cari" method="POST" class="mx-auto d-block col-md-12">
                    @csrf
                    <input type="text" class="form-control" name="x" placeholder="Cari Menu .." >
                    <input type="submit" style="position: absolute; left: -9999px"/>
                  </form>                
            </div>
        <div>        
        @foreach ($menu as $data)                    
            <div class="col-md text-left mt-3 mb-3">
                <div class="col-xs-4">
                    <div class="card card-xs">
                        <div class="card-header bg-dark text-white">
                            <div class="row">
                                <h4 class="text-white" name="lbl-namamenu">{{$data->nama_menu}}</h4>
                                <h5 class="ml-auto">                                  
                                <?php                    
                                    for ($x = 1; $x <= $data->rating; $x++) { ?>
                                        <span class="on text-warning"><i class="fa fa-star"></i></span>
                                    <?php } ?>
                                </h5>
                            </div>
                        </div>
                        <img class="img-menu" name="img-menu" src="{{ asset('images/'.$data->gambar)  }} " alt="Card image cap" data-toggle="modal" data-target="#review{{$data->id_menu}}">
                        <div class="card-body">
                            @php                                	
                                $harga = "Rp" . number_format($data->harga_menu,2,',','.');
                                $promo = $data->harga_menu - ($data->harga_menu * ($data->jumlah_promo) / 100);                           
                            @endphp                                                                                                              
                            @if ($data->jumlah_promo != null && $data->end >= date('Y-m-d'))                                                 
                            <h3 class="text-warning" name="lbl-hargapromo">Rp{{$promo}}</h3>
                            <div class="row col-md">
                                <a class="text-muted" name="lbl-hargamenu"><s>{{$harga}}</s></a>
                            <span class="text-muted ml-1">-{{$data->jumlah_promo}}%</span>
                            </div>                        
                            <span class="text-danger">Wah Asyik nih ada promo {{$data->nama_promo}}</span>
                            @else
                            <h5>{{$harga}}</h5>
                            @endif    
                            <hr>
                                                                                
                            <p class="card-text">{{$data->deskripsi}}</p>
                            <!-- Modal -->
                            <div class="modal fade" id="review{{$data->id_menu}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark ">
                                            <h5 class="modal-title text-white" name="lbl-ulasan">Ulasan</h5>
                                                <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                            $listreview = DB::table('rating_review')->where('id_menu', $data->id_menu)->orderBy('id_ratingreview','desc')->get()->take(5);
                                            @endphp                            
                                            @if ($listreview != null)
                                            <img class="img-menu" name="img-menu" src="{{ asset('images/'.$data->gambar)  }}">
                                            <div class="card text-left">                             
                                            <div class="card-body">                                                 
                                                @foreach ($listreview as $review)
                                                <div class="ml-2 mb-2 mt-2">
                                                    <blockquote><h5 class="card-text" name="lbl-review">"{{$review->review}}"</h5></blockquote>
                                                </div>
                                                @endforeach                          
                                            </div>
                                            <button type="button text-white" class="btn btn-lg btn-secondary" data-dismiss="modal" aria-label="Close">Tutup</button>                                                         
                                            </div>                                            
                                            @endif  
                                        </div>                                        
                                    </div>
                                </div>
                            </div>                                                                                                               
                            @php
                                $cek = DB::table('keranjang')->where('id_menu', $data->id_menu)->where('id_session', $sid)->first();       
                            @endphp                            
                            @if ($data->jumlah_stok != 0 and $cek == null)
                            <a class="btn btn-success text-white col-md" href="/keranjang/cek/{{$data->id_menu}}"><i class="material-icons">shopping_cart</i> Pesan</a>
                            @elseif ($data->jumlah_stok != 0 and $cek != null)
                            <a class="btn btn-danger text-white col-md" href="/keranjang/hapus/{{$data->id_menu}}"><i class="material-icons">delete</i> Batal</a>        
                            @else
                            <a class="btn btn-danger text-white col-md disabled" ></i> HABIS</a>
                            @endif                                                   
                        </div>
                    </div>
                </div>
            </div>
            @endforeach        
            
            
                
        </div>
    </body>    
@endsection
