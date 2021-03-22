@extends('header')
@section('content')
    <body id="body" class="h-100">

        <div class="container-fluid">
            <div class="row">
                <!-- Main Sidebar -->
                <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0 ">
                    <div class="main-navbar">
                        <nav
                            class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                                <div class="d-table mx-auto my-auto mr-auto ml-auto">
                                    <img
                                        id="main-logo"
                                        class="d-inline-block ml-3 mr-1"
                                        style="max-width: 15%;"
                                        src="{{ asset('images/raja-fana.png') }}"
                                        alt="Shards Dashboard">
                                    <span class="d-none d-md-inline ml-1">Raja Fana - Resto 10M</span>
                                </div>
                            </a>
                            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                                <i class="material-icons">&#xE5C4;</i>
                            </a>
                        </nav>
                    </div>
                    <div class="menu nav-wrapper bg-dark offprint">
                        <ul class="nav flex-column">
                            @auth('kasir')
                            <li class="nav-item">
                                <a class="klik_menu nav-link" id="pesanan" href="/pesanan">                                    
                                    <h5 class="text-white"><i class="material-icons">add_shopping_cart</i>Pesanan<span id="jumlah_pesanan" class="badge badge-danger ml-5">0</span></h5>
                                </a>
                            </li>                                    
                            @endauth
                            @auth('admin')
                            <li class="nav-item">
                                <a class="klik_menu nav-link" id="home" href="/beranda">
                                    <i class="material-icons">home</i>
                                    <span>Beranda</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="klik_menu nav-link" id="menu" href="/menu">
                                    <i class="material-icons">fastfood</i>
                                    <span>Prefensi Menu Restoran</span>
                                </a>
                            </li>                                               

                            <li class="nav-item">
                                <a class="nav-link klik_menu" id="promo" href="/promo">
                                    <i class="material-icons">note</i>
                                    <span>Promo</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="laporan" href="/laporan">
                                    <i class="material-icons">assessment</i>
                                    <span>Laporan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link klik_menu" id="datauser" href="/datauser">
                                    <i class="material-icons">people</i>
                                    <span>Data User</span>
                                </a>
                            </li>
                            @endauth
                            <li class="nav-item fixed-bottom" name="logout">
                                <a class="nav-link" href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="material-icons">outbond</i>
                                    <span>Keluar</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </aside>
                <!-- End Main Sidebar -->
                <main
                    class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                    <div class="main-navbar sticky-top bg-white">
                        <!-- Main Navbar -->
                        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                            <nav class="nav">
                                <a
                                    href="#"
                                    class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                                    data-toggle="collapse"
                                    data-target=".header-navbar"
                                    aria-expanded="false"
                                    aria-controls="header-navbar">
                                    <i class="material-icons">&#xE5D2;</i>
                                </a>
                            </nav>
                        </nav>
                    </div>
                    <!-- / .main-navbar -->
                    <div id="badan" class="badan main-content-container container-fluid px-4 ">
                        <!-- content -->
                        @yield('isi')
                        <!-- content -->
                    </div>
                    <footer class="main-footer d-flex p-2 px-3 bg-white border-top offprint">
                        <span class="copyright mx-auto my-auto mr-2">Copyright © 2020
                            <a href="#" rel="nofollow">Raja Fana</a>
                        </span>
                    </footer>
                </main>
            </div>
        </div>
@endsection
    </body>

</html>