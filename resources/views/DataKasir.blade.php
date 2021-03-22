@extends('dashboard')
@section('isi')

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Beranda</span>
                <h3 class="page-title">Data User</h3>
              </div> 
            </div>
            <!-- End Page Header -->
            <!-- Small Stats Blocks -->            

          <div class="container-fluid mt-5">  
            <div class="col-md-12 col-sm-12 mb-4">
              <div class="card">
                <div class="card-header bg-dark text-white container-fluid">
                  <div class="row">
                    <div class="col-md-10">
                      <h5 class="p-1 text-white">Data User</h5>
                    </div>
                    <div class="ml-auto float-right">                     
                      <button class="btn btn-primary text-white text-center" style="font-size:22px;" data-toggle="modal" data-target="#tambah" data-backdrop="static" data-keyboard="false"><i class="material-icons">local_hospital</i></button>           
                    </div>
                  </div>
                </div>
                  <div class="card-body">
                  <!-- content -->
                    <!-- <div class="col-md-12"> -->
                      <div class="row">
                      <table class="table table-bordered text-center" id="myTable">
                        <thead class="thead-dark">
                            <tr>             
                              <th scope="col">No</th>             
                              <th scope="col">Username</th>
                              <th scope="col">Nama</th>                              
                              <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>                          
                          <?php $i = 1; ?>
                            @foreach($kasir as $data)
                            <tr>                            
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->username_kasir}}</td>
                                <td>{{$data->nama_kasir}}</td>                                                                
                                <td>
                                    <a class="btn btn-success col-md-4" data-toggle="modal" data-target="#edit{{$data->id_kasir}}" data-backdrop="static" data-keyboard="false" href="">Edit</a>
                                    <a class="btn btn-danger col-md-4" href="/datauser/hapus/{{$data->id_kasir}}" onclick="return confirm('yakin?');">Hapus</a>
                                </td>
                              </tr>
                              <div class="modal fade" id="edit{{$data->id_kasir}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Kasir</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">                            
                                          <form method="POST" action="/datauser/edit">
                                            @csrf
                                              <div class="row">
                                                <input class="form-control" type="hidden" name="id_kasir" id="id_kasir" value="{{ $data->id_kasir}}" required>
                                                <div class="form-group col-md-6">
                                                  <label for="nama">Nama</label>
                                                  <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{$data->nama_kasir}}" placeholder="Masukkan Nama Kasir" required> 
                                                  @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror  
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="harga">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" onkeyup="sum();" placeholder="Username" value="{{$data->username_kasir}}" required>                                    
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="nama">Kata Sandi</label>                                    
                                                    <input type="password" class="form-control" id="password" name="password" onkeyup="sum();" placeholder="Kata Sandi" required>                                    
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="harga">Ulangi Kata Sandi</label>
                                                    <input type="password" class="form-control" id="password-confirm" name="password-confirm" onkeyup="sum();" placeholder="Ulangi Kata Sandi" required>                                    
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
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>                 
                    <!-- content  -->
                  <!-- </div> -->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambah Kasir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                            
                          <form method="POST" action="/datauser/tambah">
                            @csrf
                              <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="nama">Nama</label>                                
                                  <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Kasir" required> 
                                  @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror  
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="harga">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" onkeyup="sum();" placeholder="Username" required>                                    
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Kata Sandi</label>                                    
                                    <input type="password" class="form-control" id="password" name="password" onkeyup="sum();" placeholder="Kata Sandi" required>                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="harga">Ulangi Kata Sandi</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password-confirm" onkeyup="sum();" placeholder="Ulangi Kata Sandi" required>                                    
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
$('#password, #password-confirm').on('keyup', function () {
  if ($('#password').val() == $('#password-confirm').val()) {
    $('#password').html('Matching').css('color', 'green');
  } else 
    $('#password').html('Not Matching').css('color', 'red');
});  
</script>          
                    
@endsection