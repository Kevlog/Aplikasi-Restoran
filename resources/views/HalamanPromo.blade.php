@extends('dashboard')
@section('isi')

<!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Beranda</span>
                <h3 class="page-title">Promo</h3>
              </div> 
            </div>
            <!-- End Page Header -->
            <!-- Small Stats Blocks -->
            <div class="row pb-5">
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small bg-secondary">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase text-light">Total Promo yang Berlaku</span>
                        <h6 class="stats-small__value count my-3 text-white" name="lbl-promo">{{$aktif}}</h6>
                      </div>
                      <div class="stats-small__data text-center d-block">
                      <span class="text-success">Promo Terbaru : <a class="btn btn-success text-white">{{$terbaru}}</a></span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small bg-secondary">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase text-light">Total Promo</span>
                        <h6 class="stats-small__value count my-3 text-white" name="lbl-total">{{$jumlah}}</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="text-success">Jumlah Promo Bulan Ini : <a class="btn btn-success text-white">{{$jumlahbulanini}}</a></span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                  </div>
                </div>
              </div> 
            </div>

          <div class="container-fluid">              
            <div class="card">
              <div class="card-header bg-dark text-white container-fluid">
                <div class="row">
                  <div class="col-md-10">
                    <h5 class="p-1 text-white">Menu Promo</h5>
                  </div>
                  <div class="ml-auto float-right">
                    @if ( collect(request()->segments())->last() == 'riwayat')
                    <button class="btn btn-danger text-white text-light"><a class="text-white" style="font-size:20px;" href="/promo/"><i class="material-icons">add</i> Promo</a></button>                        
                    @else
                    <button class="btn btn-warning text-white text-light"><a class="text-white" style="font-size:20px;" href="/promo/riwayat"><i class="material-icons">history</i> Riwayat</a></button>
                    <button class="btn btn-primary text-white text-center align-self-center" data-toggle="modal" data-target="#tambah" data-backdrop="static" data-keyboard="false"><span class="material-icons">local_hospital</span></button>                      
                    @endif                                            
                  </div>
                </div>
              </div>
                <div class="card-body">
                <!-- content -->
                  <div class="">
                    <div class="row">
                      @foreach ($promo as $data)
                        <div class="col-md-3">
                          <div class="card mb-4 border-dark">
                            <img class="img-menu" src="{{ asset('images/'.$data->gambar)}}" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title border-bottom text-center">{{$data->nama_promo}}</h5>                                  
                                  <table class="table table-bordered text-center">                                    
                                    <tr>                                     
                                      <td>Potongan</td>
                                    <td>{{$data->harga_menu - $data->harga_menu * $data->jumlah_promo / 100}}</td>
                                    </tr> 
                                    <tr>                                     
                                      <td>Berlaku</td>
                                      <td>{{ \Carbon\Carbon::parse($data->end)->format('d/m/Y')}} </td>
                                    </tr>                                  
                                  </table>                                  
                                <div class="">
                                  <div class="row">
                                  <a href="" class="btn btn-success mr-auto" data-toggle="modal" data-target="#edit{{$data->id_promo}}" data-backdrop="static" data-keyboard="false"><i class="material-icons">edit</i> Edit</a>
                                  <a href="/promo/hapus/{{$data->id_promo}}" class="btn btn-danger ml-auto"><i class="material-icons">delete</i> Hapus</a>
                                  </div> 
                                </div>                                 
                              </div>
                          </div>                          
                        </div>

                      <div class="modal fade" id="edit{{$data->id_promo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header bg-dark">
                                      <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Promo</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">                            
                                    <form action="/promo/update" method="post" enctype="multipart/form-data">
                                      @csrf
                                        <div class="row">
                                          <div class="form-group col-md-6">
                                              <label for="exampleInputEmail1">Nama Promo</label>                                    
                                              <input type="text" class="form-control" name="nama_promo" placeholder="Nama Promo" value="{{$data->nama_promo}}" required>                                    
                                              <input type="text" class="form-control" name="id_promo" placeholder="ID Promo" value="{{$data->id_promo}}" hidden>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="exampleInputPassword1">Menu Promo</label>
                                              <select class="form-control" name="id_menu" id="id_menu" disabled>
                                                    <option value="{{$data->id_menu}}">{{$data->nama_menu}}</option>                                                  
                                              </select>
                                          </div>
                                        </div>
                                          <div class="form-group">
                                              <label for="exampleInputPassword1">Deskripsi Promo</label>
                                              <textarea type="text" rows="3" class="form-control" name="deskripsi" placeholder="Deskripsi Promo" required>{{$data->deskripsi}}</textarea>
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputPassword1">Diskon Promo (%)</label>
                                          <input type="number" class="form-control" name="jumlah_promo" id="update_promo{{$data->id_promo}}" onkeyup="sum{{$data->id_promo}}();" class="jumlah_promo" onkeyup="sum{{$data->id_promo}}();" placeholder="Masukkan Besar Promo (Dalam %)" value="{{$data->jumlah_promo}}">
                                          </div> 
                                        <div class="row">    
                                          <div class="form-group col-md-6">
                                              <label for="exampleInputPassword1">Harga Normal</label>
                                          <input type="text" class="form-control" name="h_normal" id="update_h_normal{{$data->id_promo}}" onkeyup="sum{{$data->id_promo}}{{$data->id_promo}}();" class="h_normal" onkeyup="sum{{$data->id_promo}}();" placeholder="Harga Normal" value="{{$data->harga_menu}}" disabled>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="exampleInputPassword1">Harga Promo</label>
                                              <input type="text" class="form-control" name="h_promo" id="update_h_promo{{$data->id_promo}}" onkeyup="sum{{$data->id_promo}}();" class="h_promo" onkeyup="sum{{$data->id_promo}}();" placeholder="Harga Promo" value="{{$data->harga_menu - $data->harga_menu * $data->jumlah_promo / 100}}" disabled>
                                          </div>
                                        </div>
                                        <div class="row">                                                                    
                                          <div class="form-group col-md-6">
                                              <label for="exampleInputPassword1">Promo Mulai</label>
                                              <input type="date" class="form-control" name="start" placeholder="Harga Promo" value="{{$data->start}}" required>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="exampleInputPassword1">Promo Selesai</label>
                                              <input type="date" class="form-control" name="end" placeholder="Harga Promo" value="{{$data->end}}" required>
                                          </div>
                                        </div>                                                                                              
                                  </div>
                                  <div class="modal-footer">                            
                                      <button type="submit" class="btn btn-success"><i class="material-icons">edit</i> Perbarui</button>
                                  </form>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons"></i> Batal</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <script>
                        function sum{{$data->id_promo}}() {
                            var diskon = document.getElementById("update_promo{{$data->id_promo}}").value;
                            var normal = document.getElementById("update_h_normal{{$data->id_promo}}").value;
                            var h_diskon = (parseFloat(normal) * parseFloat(diskon)) / 100;
                            var result = parseFloat(normal) - parseFloat(h_diskon);
                            if (!isNaN(result)) {
                                document.getElementById("update_h_promo{{$data->id_promo}}").value = result;
                            }
                        } 
                      </script>
                        @endforeach
                    </div>
                  </div>                 
                  <!-- content  -->
                </div>
              </div>
            </div>            
          </div>
                                

          <!-- Modal -->
          <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Promo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                            
                          <form action="/promo/tambah" method="post" enctype="multipart/form-data">
                            @csrf
                              <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama Promo</label>                                    
                                    <input type="text" class="form-control" name="nama_promo" placeholder="Nama Promo" required>                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="menu">Menu Promo</label>
                                    <select class="form-control" name="id_menu" id="tambah_id_menu" required>
                                      <option>PILIH MENU</option>
                                      @foreach ($menu as $data)
                                          <option value="{{$data->id_menu}}">{{$data->nama_menu}}</option>
                                      @endforeach
                                    </select>
                                </div>
                              </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi Promo</label>
                                    <textarea type="text" rows="3" class="form-control" name="deskripsi" placeholder="Deskripsi Promo" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="diskon">Diskon Promo (%)</label>
                                    <input type="number" class="form-control" name="jumlah_promo" onkeyup="sum();" id="tambah_promo" placeholder="Masukkan Besar Promo (Dalam %)" required>
                                </div> 
                              <div class="row">    
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Harga Normal</label>
                                <input type="text" class="form-control" name="h_normal" id="tambah_h_normal" onkeyup="sum();" placeholder="Harga Normal" value="1" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Harga Promo</label>
                                    <input type="text" class="form-control" name="h_promo" id="tambah_h_promo" onkeyup="sum();" placeholder="Harga Promo" readonly>
                                </div>
                              </div>
                              <div class="row">                                                                    
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Promo Mulai</label>
                                    <input type="date" class="form-control" name="start" placeholder="Harga Promo" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Promo Selesai</label>
                                    <input type="date" class="form-control" name="end" placeholder="Harga Promo" required>
                                </div>
                              </div>                                                                                              
                        </div>
                        <div class="modal-footer">                            
                            <button type="submit" class="btn btn-success"><i class="material-icons">add</i> Tambahkan</button>
                        </form>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons"></i> Batal</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>          
<script>

    function sum() {
        var diskon = document.getElementById("tambah_promo").value;
        var normal = document.getElementById("tambah_h_normal").value;
        var h_diskon = (parseFloat(normal) * parseFloat(diskon)) / 100;
        var result = parseFloat(normal) - parseFloat(h_diskon);
        if (!isNaN(result)) {
            document.getElementById("tambah_h_promo").value = result;
        }
    }    

    $(function () {
      $('#tambah_id_menu').on('change', function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                url: '/promo/dataharga',
                type: 'POST',
                data: {_token: CSRF_TOKEN, id: $(this).val()},
                dataType: 'JSON',
                success: function(data) {
                $('#tambah_h_normal').val('');
                $('#tambah_h_normal').val(data);
                $('#update_h_normal').val('');
                $('#update_h_normal').val(data);
            }
        });    
      });
    });
</script>              
@endsection
