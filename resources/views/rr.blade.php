@extends('header')
@section('content')
<body style="max-width: 425px; margin: 0 auto !important; float: none !important;">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand text-white mr-auto ml-auto d-block" href="#">
            <h3 class="text-white">Restoran</h3>
        </a>
    </nav>
    <hr>
    @foreach ($menu as $data)
    <div class="d-flex justify-content-center">
        <div class="col-md-12 text-center mb-5">
            <div class="row">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="text-white">Beritahu kami ^^</h4>
                    </div>
                    <img class="img-menu" src="{{ asset('images/'.$data->gambar)  }}" alt="">
                    <div class="card-body">
                        <hr>
                        <a class="btn btn-success text-center text-white col-md">Beri Rating Yuk</a>
                            <div class="align-item-center">
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" onclick="rate(this.id)"/><label class = "full" for="star5" title="Awesome - 5 stars"></label>                                    
                                    <input type="radio" id="star4" name="rating" value="4" onclick="rate(this.id)"/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>                                    
                                    <input type="radio" id="star3" name="rating" value="3" onclick="rate(this.id)"/><label class = "full" for="star3" title="Meh - 3 stars"></label>                                    
                                    <input type="radio" id="star2" name="rating" value="2" onclick="rate(this.id)"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>                                    
                                    <input type="radio" id="star1" name="rating" value="1" onclick="rate(this.id)"/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>                                                                        
                                </fieldset>
                                
                            </div>
                        <hr>
                        <a class="btn btn-success text-center text-white col-md">Kasih Ulasan juga yaa</a>
                        <form action="/ulasan/tambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-2">
                                <input type="text" name="rating" id="rating" value="" hidden/>                             
                                <input type="text" name="id_menu" id="id_menu" value="{{$data->id_menu}}" hidden/>                             
                                <textarea class="form-control" name="ulasan" id="ulasan" rows="3" placeholder="Tulis ulasanmu di sini..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-success text-white col-md" name="btn-kirim">Kirim</button>
                            <a class="btn btn-danger text-white col-md mt-2" href="/reset" name="btn-tutup">Tutup</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
<script>
   function rate(id) {
        var rate = document.getElementById(id).value;
        // alert(rate);
        $("#rating").val(rate); 
        // console.log();
    };
</script>
</html>
@endsection