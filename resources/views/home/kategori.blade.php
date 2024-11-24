@extends('home.home-layout')
@section('content')
    <style>
        ul {
            position: relative;
            display: block;
            overflow: hidden;
        }

        ul li {
            position: relative;
            display: flex;
            align-items: center;
            line-height: 26px;
            margin-bottom: 14px;
        }

        ul li:last-child {
            margin-bottom: 0;
        }

        ul li span {
            position: relative;
            line-height: 20px;
            top: 2px;
        }

        ul li span:before {
            position: relative;
            display: inline-block;
            padding-right: 10px;
            font-size: 18px;
            color: #788eab;
        }

        ul li a {
            position: relative;
            display: inline-block;
            color: #788eab;
            font-size: 17px;
            font-weight: 400;
            font-family: var(--thm-font);
            transition: all 200ms linear;
            transition-delay: 0.1s;
        }

        ul li a sup {
            color: #788eab;
        }

        ul li a:hover {
            color: #d1143e;
        }

        ul li a:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            height: 1px;
            transform: perspective(400px) scaleX(0);
            transform-origin: center;
            transition: all 300ms linear;
            transition-delay: 0.2s;
            background: var(--thm-base);
            z-index: 1;
        }

        ul li a:hover:before {
            transform: perspective(400px) scaleX(1.0);
        }

        .top-categories-area {
            padding: 30vh 0;
        }

        @media only screen and (max-width: 768px) {
            .kategori-list {
                display: none;
            }


            .top-categories-area {
                padding: 15vh 0;
            }
        }
    </style>
    <section class="top-categories-area">
        <div class="container">
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 kategori-list">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kategori Tersedia</h5>
                            <ul class="">
                                @foreach ($dropdown_kategori as $kategori_list)
                                    <li><a href="{{ route('home.kategori', $kategori_list->nama_kategori) }}"
                                            data-id="{{ $kategori_list->id }}">
                                            {{ $kategori_list->nama_kategori }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
                    <div class="row rows-col-3">
                        @foreach ($kategori->produk as $produk)
                            <li class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 top-categories-single py-0">
                                <div class="top-categories-single__box">
                                    <div class="img-box">
                                        <div class="">
                                            <img src="{{ asset('produk/' . $produk->gambar_produk) }}"
                                                style="height: 200px; object-fit:cover;" alt="">
                                        </div>
                                        <div class="overlay-content border">
                                            {{-- <p>76 Courses</p> --}}
                                            <h3 class="mt-2"><a href="#">{{ $produk->nama_produk }}</a></h3>
                                            <div class="btns-box">
                                                <a class="btn-one btn-one--style4"
                                                    href="{{ route('home.detail-produk', $produk->id) }}">
                                                    <span class="txt">
                                                        <i class="icon-right-arrow-1"></i>
                                                        Lihat Produk
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        {{-- <h3>Kategori {{ $kategori->nama_kategori }}</h3> --}}


    </section>
@endsection
