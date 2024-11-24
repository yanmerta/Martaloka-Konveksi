@extends('home.home-layout')
@section('title', 'Detail produk')
@section('content')

    <style>
        .nice-select {
            padding-right: 100px !important;
        }

        .carousel-section {
            margin-bottom: 20px;
        }

        .product-info-section {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .product-info-section .description-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
            position: relative;
        }

        .product-info-section .description-title:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background-color: var(--thm-base);
        }

        .product-description {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
            text-align: justify;
            margin: 0;
        }

        .specification-list {
            margin-top: 20px;
            padding-left: 0;
            list-style: none;
        }

        .specification-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #eee;
        }

        .specification-list li:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .spec-label {
            font-weight: 500;
            color: #333;
            width: 120px;
            flex-shrink: 0;
        }

        .spec-value {
            color: #666;
        }

        @media (max-width: 768px) {
            .product-info-section {
                padding: 20px;
                margin-bottom: 20px;
            }

            .specification-list li {
                flex-direction: column;
            }

            .spec-label {
                margin-bottom: 5px;
            }
        }
    </style>
    <div style="margin-top: 20vh;">
        <section class="events-details-page">
            <div class="container">
                @include('home.flash')

                <div class="row">
                    <div class="col-xl-8">
                        <div class="carousel-section bg-dark">
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('produk/' . $produk->gambar_produk) }}"
                                            style="height: 70vh; object-fit:contain;" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/images/size-guide.jpeg') }}"
                                            style="height: 70vh; object-fit:contain;" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>

                        <div class="product-info-section">
                            <h4 class="description-title">Deskripsi Produk</h4>
                            <p class="product-description">{{ $produk->deskripsi }}</p>
                        </div>
                    </div>

                    <!--Start Single Event Three-->
                    <div class="col-xl-4 col-lg-6 col-md-7">
                        <form action="{{ route('home.addToCart', $produk->id) }}" method="POST">
                            @csrf
                            <div class="events-details-info-box">
                                <div class="inner-title">
                                    <div class="dot-box"></div>
                                    <h3>Detail Produk</h3>
                                </div>
                                <ul class="events-details-info-box__items">
                                    <li>
                                        Nama Produk <span>{{ $produk->nama_produk }}</span>
                                    </li>
                                    <li>
                                        Kategori <span>{{ $produk->kategori->nama_kategori }}</span>
                                    </li>
                                    <li>
                                        Harga <span
                                            class="font-weight-bold">Rp.{{ number_format($produk->harga_produk) }}</span>
                                    </li>
                                    <li>
                                        Stok Tersedia <span
                                            class="font-weight-bold">{{ number_format($produk->stok) }}</span>
                                    </li>
                                    <li>
                                        Size
                                        <div>
                                            <select class="nice-select w-25" name="size"
                                                style="padding-right:60px !important;">
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="XXL">XXL</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>

                                <div class="btns-box w-100" style="margin-top: 100px;">
                                    <button type="submit" class="btn-one btn-one--style2 w-100 ">
                                        <span class="txt d-inline">Tambahkan Ke Keranjang</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End Single Event Three-->
                </div>
            </div>
        </section>
        <!--End Events Details Page-->
    </div>
@endsection
