<aside class="main-sidebar sidebar-dark-red elevation-4" style="background-color: #1e1d1e">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        {{-- <img src="{{ asset('auth-views/assets/media/logos/icon-logo.png') }}" alt="" class="brand-image"
            style="width: 52px; height: auto;" style="opacity: .8"> --}}
        <div class="text-center">
            <span class="brand-text font-weight-light ml-0">Martaloka Konveksi</span>
        </div>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('auth-views/assets/media/logos/user.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info pl-3">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                {{-- <span class="d-block" style="color: white;">Super Admin</span> --}}
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar bg-light" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar bg-light ">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">INTRO</li>
                <li class="nav-item ">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right "></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul> -->
                </li>
                {{-- <li class="nav-item">
            <a href="{{route('transaksi.index')}}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li> --}}
                {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Transaksi
              </p>
            </a>

          </li> --}}
                <li class="nav-item">
                    <a href="{{ route('beranda') }}"
                        class="nav-link {{ request()->routeIs('beranda') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            See Website
                        </p>
                    </a>
                </li>
                <li class="nav-header" style="margin-top: -20px;">MANAGE PRODUK</li>
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}"
                        class="nav-link {{ request()->routeIs('produk.index') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kategori.index') ? 'menu-open active' : '' }}"
                        href="{{ route('kategori.index') }}">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <li class="nav-header" style="margin-top: -20px;">MANAGE TRANSAKSI</li>
                <li class="nav-item">
                    <a href="{{ route('transaksi.index') }}"
                        class="nav-link {{ request()->routeIs('transaksi.index') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>Transaksi</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('transaksiCustom.index') }}"
                        class="nav-link {{ request()->routeIs('transaksiCustom.index') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-paint-brush"></i>
                        <p>Transaksi Custom Design</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('transaksi.riwayatTransaksi') }}"
                        class="nav-link {{ request()->routeIs('transaksi.riwayatTransaksi') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Transaksi Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('transaksiCustom.riwayatTransaksi') }}"
                        class="nav-link {{ request()->routeIs('transaksiCustom.riwayatTransaksi') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Riwayat Transaksi Custom</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('progress-pembelian.index') }}"
                        class="nav-link {{ request()->routeIs('progress-pembelian.index') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Progress Transaksi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('progress-custom.index') }}"
                        class="nav-link {{ Request::is('transaksi/progress-custom') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>Progress Custom Design</p>
                    </a>
                </li>

                <li class="nav-header" style="margin-top: -20px;">MANAGE USER</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ request()->routeIs('users.index') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User Manajemen</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kontak.index') }}"
                        class="nav-link {{ request()->routeIs('kontak.index') ? 'menu-open active' : '' }}">
                        <i class="nav-icon fas fa-paper-plane"></i>
                        <p>Kontak</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
