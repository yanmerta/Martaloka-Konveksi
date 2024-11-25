<header class="main-header header-style-one">
    <!--Start Header Top-->
    <div class="header-top">
        <div class="auto-container">
            <div class="outer-box">
                <div class="header-top-left">
                </div>

                <div class="header-top-right">
                    <div class="quick-link-box">
                        <div class="inner-title">
                            @guest
                                <span class="icon-launch"></span>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endguest
                        </div>
                        <div class="link-box">
                            <ul>
                                @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @endguest

                                @auth
                                    <li><a href="{{ route('profileuser.edit') }}"><i
                                                class="icon-account mr-2"></i>{{ Auth::user()->name }} </a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Top-->

    <!--Start Header-->
    <div class="header {{ Request::is('/') || Request::is('kontak') || Request::is('tentang-kami') ? '' : 'bg-dark' }}">
        <div class="auto-container">
            <div class="outer-box">
                <div class="header-left"></div>
                <div class="header-middle">
                    <div class="main-logo-box">
                        <a href="{{ route('beranda') }}">
                            <img style="height: 90px; max-width: 67%; object-fit: contain; position: relative; top: -15px;" 
                                 src="{{ asset('assets/images/logoo2.png') }}" alt="" title="">
                        </a>
                    </div>
                
                    <div class="nav-outer style1 clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <div class="inner">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                        </div>
                        <!-- Main Menu -->
                        <nav class="main-menu style1 navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="{{ request()->is('/') ? 'current' : '' }}">
                                        <a href="{{ route('beranda') }}">Beranda</a>
                                    </li>

                                    <li class="{{ request()->routeIs('home.tentang-kami') ? 'current' : '' }}">
                                        <a href="{{ route('home.tentang-kami') }}">Tentang Kami</a>
                                    </li>

                                    <li class="blank-box"></li>

                                    <li class="dropdown {{ request()->is('kategori/*') ? 'current' : '' }}">
                                        <a href="#">Kategori</a>
                                        <ul>
                                            @foreach ($dropdown_kategori as $dropDown)
                                                <li class="{{ request()->is('kategori/' . $dropDown->nama_kategori) ? 'current' : '' }}">
                                                    <a href="{{ route('home.kategori', $dropDown->nama_kategori) }}">{{ $dropDown->nama_kategori }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li class="{{ request()->routeIs('home.kontak') ? 'current' : '' }}">
                                        <a href="{{ route('home.kontak') }}">Kontak Kami</a>
                                    </li>

                                    @auth
                                        <li class="dropdown {{ request()->is('profil/*') ? 'current' : '' }}">
                                            <a href="#">{{ Auth::user()->name }}</a>
                                            <ul>
                                                <li class="{{ request()->is('keranjang') ? 'current' : '' }}">
                                                    <a href="{{ route('home.keranjang') }}">Keranjang</a>
                                                </li>
                                                <li class="{{ request()->is('daftar-transaksi-pembelian') ? 'current' : '' }}">
                                                    <a href="{{ route('home.daftarTransaksiPembelian') }}">Transaksi</a>
                                                </li>
                                                <li class="{{ request()->is('daftar-custom') ? 'current' : '' }}">
                                                    <a href="{{ route('home.daftarCustom') }}">Custom Design</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @endauth

                                    @guest
                                        <div class="d-xxl-none d-xl-none d-lg-none">
                                            <li><a href="{{ route('register') }}">Register</a></li>
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        </div>
                                    @endguest
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="header-right"></div>
            </div>
        </div>
    </div>
    <!--End header-->

    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="container">
            <div class="sticky-header__inner clearfix">
                <div class="logo float-left">
                    <a href="index.html" class="img-responsive">
                        <img src="{{ asset('assets/images/logo1.png') }}" alt="" title="">
                    </a>
                </div>
                <div class="right-col float-right">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--End Sticky Header-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon fa fa-times-circle"></span></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="index.html">
                    <img src="assets/images/resources/mobilemenu-logo.png" alt="" title="">
                </a>
            </div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->

    <!-- Tambahkan CSS ini di bagian head atau file CSS terpisah -->
    <style>
        /* Style untuk menu utama */
        .main-menu .navigation > li > a {
            color: #ffffff !important;
            font-weight: 500;
            text-transform: capitalize;
            padding: 12px 20px;
            transition: all 300ms ease;
        }

        /* Style untuk menu yang aktif */
        .main-menu .navigation > li.current > a {
            color: #ff0000 !important;
            background: transparent;
        }

        /* Style untuk dropdown menu */
        .main-menu .navigation > li > ul {
            background: #ececec;
            min-width: 200px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .main-menu .navigation > li > ul > li > a {
            color: #333333 !important;
            padding: 10px 20px;
            transition: all 300ms ease;
        }

        /* Style untuk item dropdown yang aktif */
        .main-menu .navigation > li > ul > li.current > a {
            color: #ff0000 !important;
            background-color: rgba(255,0,0,0.05);
        }

        /* Hover effects */
        .main-menu .navigation > li > a:hover,
        .main-menu .navigation > li > ul > li > a:hover {
            color: #ff0000 !important;
        }

        /* Penyesuaian posisi navbar */
        .nav-outer {
            display: flex;
            align-items: center;
            height: 100%;
            padding-top: 25px; /* Sesuaikan nilai ini untuk mengatur posisi vertikal navbar */
        }

        .main-menu {
            display: flex;
            align-items: center;
        }

        .navigation {
            display: flex;
            align-items: center;
            margin: 0;
        }

        /* Mobile menu styles */
        @media only screen and (max-width: 991px) {
            .mobile-menu .navigation > li.current > a {
                color: #ff0000 !important;
            }
            
            .mobile-menu .navigation > li > ul > li.current > a {
                color: #ff0000 !important;
            }

            .nav-outer {
                padding-top: 0; /* Reset padding for mobile view */
            }
        }
        /* Navbar tulisan berubah warna hitam saat di-scroll */
        .sticky-header .main-menu .navigation > li > a {
            color: #000000 !important;
        }

        .sticky-header .main-menu .navigation > li.current > a {
            color: #ff0000 !important;
        }

        .sticky-header .main-menu .navigation > li > ul > li > a {
            color: #000000 !important;
        }

        /* Saat scroll, ubah warna navbar */
        .sticky-header {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
</header>

