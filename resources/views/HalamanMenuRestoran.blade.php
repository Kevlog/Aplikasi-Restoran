@extends('dashboard')
@section('isi')
    

<!-- Page Header -->

            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Beranda</span>
                <h3 class="page-title">Menu</h3>
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
                        <span class="stats-small__label text-uppercase">Jumlah Menu</span>
                        <h6 class="stats-small__value count my-3 text-white" name="lbl-jumlah">{{$jumlahmenu}}</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="text-success">Menu Makanan terbaru : <a class="btn btn-success text-white">{{$menuterbaru}}</a></span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                  </div>
                </div>
              </div>

          <div class="container-fluid">  
            <div class="col-md-12 mb-4">
              <div class="card">
                <div class="card-header bg-dark text-white container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <a href="/menu"><h5 class="p-1 text-white">Menu Restoran</h5></a>
                        <form action="/menu/cari" method="POST" class="ml-auto d-block col-md-6">
                          @csrf
                          <input type="text" class="form-control transparent-input col-md-12 " name="x" placeholder="Cari Menu .." >
                          <input type="submit" style="position: absolute; left: -9999px"/>
                        </form>
                        {{-- <input class="form-control transparent-input col-md-6 ml-auto" type='text' name='name' placeholder="Cari Menu"  required>                                           --}}
                          <div class="ml-auto float-right">                    
                            <button class="btn btn-primary text-white text-center" name="btn-tambahmenu" data-toggle="modal" data-target="#tambah" data-backdrop="static" data-keyboard="false"><span class="material-icons">local_hospital</span></button>           
                          </div>
                      </div>                      
                    </div>                                                           
                  </div>
                </div>                
                  <div class="card-body">
                  <!-- content -->
                    <!-- <div class="col-md-12"> -->
                      <div class="row">
                        @foreach ($menu as $data)                                                    
                            <div class="col-md-3">
                            <div class="card mb-4 border-dark">
                                <img class="img-menu" src="{{ asset('images/'.$data->gambar)  }} " alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title border-bottom text-center">{{$data->nama_menu}}</h5>
                                  <table class="table table-bordered text-center">                                    
                                    <tr>                                     
                                      <td>Harga</td>
                                      <td>{{$data->harga_menu}}</td>
                                    </tr> 
                                    <tr>                                     
                                      <td>Stok</td>
                                      <td>{{$data->jumlah_stok}}</td>
                                    </tr>                                  
                                  </table>
                                  <div class="col-md">
                                    <div class="row">
                                    <a href="" class="btn btn-success mr-auto" name="btn-edit" data-toggle="modal" data-target="#edit{{$data->id_menu}}" data-backdrop="static" data-keyboard="false"><i class="material-icons">edit</i> Edit</a>
                                      <a href="/menu/hapus/{{$data->id_menu}}" class="btn btn-danger ml-auto" name="btn-hapus">Hapus</a>
                                    </div> 
                                  </div>                                 
                                </div>
                            </div>
                          </div>
                          
                        <div class="modal fade" id="edit{{$data->id_menu}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark">
                                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">                            
                                        <form action="/menu/update" method="post" enctype="multipart/form-data">
                                          <div class="row">
                                            <div class="form-group col-md-6">
                                              @csrf
                                                <input class="form-control" type="hidden" name="id_menu" id="id_menu" value="{{ $data->id_menu}}">
                                                <label for="nama">Nama Menu</label>
                                                <input class="form-control @error('nama_menu') is-invalid @enderror" type="text" name="nama_menu" id="nama_menu"  value="{{$data->nama_menu}}"> 
                                                @error('nama_menu')
                                                  <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror                                                                        
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="harga">Harga / Porsi</label>
                                                <input type="text" class="form-control" id="harga_menu" onkeyup="sum();" name="harga_menu" value="{{$data->harga_menu}}">                                     
                                            </div>
                                            <div class="form-group col-md-12">
                                              <label for="harga">Jenis Menu</label>
                                              <select class="form-control" name="jenis_menu" id="jenis_menu" readonly>
                                                <option value="{{$data->jenis_menu}}">{{$data->jenis_menu}}</option>                                                    
                                            </select>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi Menu</label>
                                                <textarea type="text" rows="3" class="form-control" id="deskripsi" name="deskripsi" onkeyup="sum();">{{$data->deskripsi}}</textarea>
                                            </div>
                                            <div class="form-group">
                                              <label for="gambar">Foto</label>
                                              <input type="file" accept=".jpg,.png" class="form-control-file" name="gambar" id="gambar">
                                            </div>
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <div  class="row col-md-6">
                                                  <div class="form-group-btn">
                                                    <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="jumlah_stok">
                                                    <i class="material-icons">remove</i>
                                                    </button>
                                                  </div>
                                                  <input type="text" name="jumlah_stok" class="form-control input-number col-md-4" value="{{$data->jumlah_stok}}" min="0" max="100">
                                                  <div class="form-group-btn">
                                                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="jumlah_stok">
                                                      <i class="material-icons">add</i>
                                                      </button>
                                                  </div>
                                                </div>
                                            </div>                                                                                                                                                            
                                          <div class="modal-footer">                            
                                              <button type="submit" class="btn btn-success"><i class="material-icons" name="btn-perbarui">add</i> Perbarui</button>
                                          </form>
                                              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons" name="btn-batal"></i> Batal</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                      
                          @endforeach
                      </div>
                    <!-- </div>                  -->
                    <!-- content  -->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                            
                          <form action="/menu/store" method="post" enctype="multipart/form-data">
                              <div class="row">
                                <div class="form-group col-md-12">
                                  @csrf
                                    <label for="nama">Nama Menu</label>
                                    <input class="form-control @error('nama_menu') is-invalid @enderror" type="text" name="nama_menu" id="nama_menu"  placeholder="Masukkan Nama Menu"> 
                                    @error('nama_menu')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror                                                                        
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="harga">Harga / Porsi</label>
                                    <input type="text" class="form-control" id="harga_menu" onkeyup="sum();" name="harga_menu" placeholder="Harga">                                    
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="harga">Jenis Menu</label>
                                  <select class="form-control" name="jenis_menu" id="jenis_menu">
                                    <option value="makanan">Makanan</option>                                                  
                                    <option value="minuman">Minuman</option>                                                  
                                </select>
                                </div>                              
                                <div class="form-group col-md-12">
                                    <label for="deskripsi">Deskripsi Menu</label>
                                    <textarea type="text" rows="3" class="form-control" id="deskripsi" name="deskripsi" onkeyup="sum();" placeholder="Deskripsi Menu"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                  <label for="gambar">Foto</label>
                                  <input type="file" accept=".jpg,.png" class="form-control-file" name="gambar" id="gambar">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="stok">Stok</label>
                                    <div  class="row col-md-12">
                                      <div class="form-group-btn">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="jumlah_stok">
                                        <i class="material-icons">remove</i>
                                        </button>
                                      </div>
                                      <input type="text" name="jumlah_stok" class="form-control input-number col-md-4" value="15" min="0" max="100">
                                      <div class="form-group-btn">
                                          <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="jumlah_stok">
                                          <i class="material-icons">add</i>
                                          </button>
                                      </div>
                                    </div>
                                </div>                                                                                                                  
                        </div>
                        <div class="modal-footer">                            
                            <button type="submit" class="btn btn-success" name="btn-tambah"><i class="material-icons">add</i> Tambahkan</button>
                        </form>
                            <button type="button" class="btn btn-danger" name="btn-hapus" data-dismiss="modal"><i class="material-icons"></i> Batal</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
                 

  <script>
    $('.btn-number').click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input
                        .val(currentVal - 1)
                        .change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input
                        .val(currentVal + 1)
                        .change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr(
                'disabled'
            )
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr(
                'disabled'
            )
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }

    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [
            46,
            8,
            9,
            27,
            13,
            190
        ]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
@endsection                                