@extends('dashboard')
@section('isi')
    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Beranda</span>
        <h3 class="page-title">Overview</h3>
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
                        <span class="stats-small__label text-uppercase">Total Transaksi</span>
                        <h6 class="stats-small__value count my-3 text-white" name="lbl-total">{{$transaksi}}</h6>
                    </div>
                    <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">Hari Ini Ada {{$transaksitoday}}</span>
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
                        <span class="stats-small__label text-uppercase text-light">Total Pendapatan</span>
                    <h6 class="stats-small__value count my-3 text-white" name="lbl-pendapatan">Rp.{{number_format($pendapatan)}}</h6>
                    </div>
                    <div class="stats-small__data">
                        <!-- <span class="stats-small__percentage
                        stats-small__percentage--increase">12.4%</span> -->
                    </div>
                </div>
                <canvas height="120" class="blog-overview-stats-small-3"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- End Small Stats Blocks -->
<div class="row mt-5 mb-5">
    <!-- Content -->
    <img id="main-logo" class="d-inline-block align-top mx-auto mt-5" style="max-width: 100%;" src="images/raja-fana.png" alt="Shards Dashboard"></img>
</div>

@endsection