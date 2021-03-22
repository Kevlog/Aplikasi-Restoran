@extends('header')
@section('content')    
<body
        style="max-width: 425px; margin: 0 auto !important; float: none !important;">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand text-white mr-auto ml-auto d-block" href="#">
                <h3 class="text-white">Restoran</h3>
            </a>
        </nav>
        <hr>
        <div class="card text-left">
            <div class="card-header bg-dark">
                <h4 class="text-white" name="lbl-keranjang">Keranjang</h4>
            </div>            
            <div class="card-body">
                
                <table class="table table-bordered text-center" id="myTable">
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
                        @endphp                             
                        @foreach($keranjang as $data)
                        @php
                            $hargafix    = $data->harga_menu;
                            if ($data->end >= date('y-m-d') ) {
                                $hargafix    = $data->harga_menu - ($data->harga_menu * $data->jumlah_promo / 100);
                            }                            
                            $subtotal    = $hargafix * $data->jumlah;    
                            $total       = $total + $subtotal;                        
                        @endphp     
                        <tr>                            
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama_menu}}</td>
                            <td><input type="text" class="text-center" id="jumlah{{$loop->iteration}}" name="jumlah" value="{{$data->jumlah}}" maxlength="4" size="4" onkeyup="sum{{$loop->iteration}}()"></td>                            
                            <td id="hargaku{{$loop->iteration}}">{{$subtotal}}</td>                                                                                           
                            <td><a class="btn btn-danger text-white" href="/keranjang/chapus/{{$data->id_menu}}"><i class="material-icons">delete</i></a></td> 
                        </tr>
                        <script>
                            function sum{{$loop->iteration}}() {
                                var CSRF_TOKEN{{$loop->iteration}} = $('meta[name="csrf-token"]').attr('content');
                                var jumlah = document.getElementById("jumlah{{$loop->iteration}}").value;
                                var total = {{$hargafix}};                                
                                var result = parseFloat(jumlah) * parseFloat(total);
                                if (!isNaN(result)) {                                   
                                        document.getElementById("hargaku{{$loop->iteration}}").innerHTML = result;                                        
                                        $.ajax({
                                                url: '/keranjang/tambahjumlah',
                                                type: 'POST',
                                                data: {_token: CSRF_TOKEN{{$loop->iteration}}, id: {{$data->id_menu}}, jumlah: $('#jumlah{{$loop->iteration}}').val()},
                                                dataType: 'JSON',
                                                success: function() {                                                         
                                            }                                            
                                        });
                                        setTimeout(function () { 
                                            document.location.reload(true);
                                        }, 1000);                                                                                
                                       
                                }
                                
                            } 
                          </script>
                        @endforeach                       
                        <tr>
                            <td colspan="3">Total</td>
                            <td colspan="2" id="total_keranjang">{{$total}}</td>
                            <input type="text" class="text-center" id="id_menu" name="id_menu" value="{{$data->id_menu}}" maxlength="4" size="4" hidden>
                        </tr>                                                
                    </tbody>
                </table>
                {{-- {{ dd($keranjang->toArray())}} --}}
                <form action="/keranjang/selesai" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">No. Meja</label>                       
                        <input
                            type="number"
                            class="form-control"
                            id="nomer_meja"
                            name="nomer_meja"                            
                            placeholder="Nomor meja">
                        </input>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>                       
                        <input
                            type="text"
                            class="form-control"
                            id="nama_customer"
                            name="nama_customer"                            
                            placeholder="Nama">
                        </input>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Total Harga</label>
                        <input
                            type="text"
                            class="form-control"
                            id="total"
                            name="total"                            
                            placeholder=""
                            value="{{$total}}" readonly>
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success col-md text-white" name="btn-pesan"><i class="material-icons">check</i> Pesan</button>
                    <a class="btn btn-danger" href="/" name="lbl-batal"><i class="material-icons">delete</i> Batal</a>
                    </form>
                </div>
        </div>
    </body>    
</html>
@endsection