@extends('home.home-layout')
@section('title', 'Pemesanan Custom Desain')
@section('content')


    <style>
        .nice-select {
            line-height: unset !important;
            height: auto;
            padding: 10px;
            margin-bottom: 16px;

        }

        .nice-select .list {
            width: 100% !important;

        }
    </style>



    <section class="top-categories-area" style="padding: 30vh 0;">
        <div class="container-fluid container-xxl container-xl container-lg container-md">
            @include('home.flash')
            <h2 class="text-center">Pemesanan Custom Desain</h2>
            <form action="{{ route('home.storeDesign') }}" method="POST" class="d-block" enctype="multipart/form-data">
                @csrf

                <div class="row mt-5">
                    <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 px-xxl-5 px-xl-5 px-lg-5">
                        <div class="form-group mb-4">
                            <h6 class="mb-2" for=" ">Nama</h6>
                            <input id=" " class="form-control" type="text" name="nama_pemesan" required
                                value="{{ Auth::user()->name }}">
                            <label>Isikan sesuai nama lengkap anda</label>
                        </div>
                        <div class="form-group mb-4">
                            <h6 class="mb-2" for=" ">Alamat</h6>
                            <input id=" " class="form-control" type="text" name="alamat_pemesan" required
                                value="{{ Auth::user()->alamat }}">
                            <label>Isikan sesuai alamat anda secara lengkap </label>

                        </div>
                        <div class="form-group mb-4">
                            <h6 class="mb-2" for=" ">Email</h6>
                            <input id=" " class="form-control" type="email" name="email_pemesan" required
                                value="{{ Auth::user()->email }}">
                            <label>Gunakan '@' , contoh : martaloka@gmail.com</label>

                        </div>
                        <div class="form-group mb-4">
                            <h6 class="mb-2" for=" ">Nomor Telepon</h6>
                            <input id=" " class="form-control" type="number" name="nomor_hp_pemesan" required
                                value="{{ Auth::user()->nomor_hp }}">
                            <label>Masukkan nomor telepon, contoh : 08123456789</label>

                        </div>

                        <div class="form-group mb-4">
                            <h6 class="mb-2" for=" ">Jenis Pesanan</h6>
                            <div class="select-box">
                                <select class="wide float-none"
                                    style="height: 40px !important;line-height: 40px !important;" name="kategori_id">
                                    @foreach ($kategori as $select)
                                        <option value="{{ $select->id }}">{{ $select->nama_kategori }} -
                                            Rp. {{ number_format($select->harga_kategori) }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="form-group mb-3">
                            <h6 class="mb-2" for="delivery">Delivery</h6>
                            <select class="form-control w-100" id="delivery" name="delivery" required>
                                <option value="Diantar ke Tempat Pemesan">Diantar ke Tempat Pemesan</option>
                                <option value="Ambil di Martaloka">Ambil di Martaloka</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 px-xxl-5 px-xl-5 px-lg-5">
                        <div class="form-group mb-4">
                            <h6 class="mb-2" for=" ">Nama Custom</h6>
                            <input id=" " class="form-control" type="text" name="nama_custom" required>
                            <label>Beri nama identitas custom</label>
                        </div>

                        <div class="co">
                            <h6 class="mb-2">Cowok</h6>
                            <hr>
                            <div class="row ">

                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> S</label>
                                        <input id="co_s" class="form-control" type="number" name="co_s"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> M</label>

                                        <input id="co_m" class="form-control" type="number" name="co_m"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> L</label>

                                        <input id="co_l" class="form-control" type="number" name="co_l"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> XL</label>

                                        <input id="co_xl" class="form-control" type="number" name="co_xl"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> XXL</label>

                                        <input id="co_xxl" class="form-control" type="number" name="co_xxl"
                                            value="0">
                                    </div>
                                </div>

                            </div>

                            <h6 class="mb-2">Cowok Anak</h6>
                            <hr>
                            <div class="row">

                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> S </label>

                                        <input id="co_l1" class="form-control" type="number" name="co_l1"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> M</label>

                                        <input id="co_l2" class="form-control" type="number" name="co_l2"
                                            value="0">
                                    </div>
                                </div>

                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> L</label>

                                        <input id="co_l3" class="form-control" type="number" name="co_l3"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> XL</label>

                                        <input id="co_l4" class="form-control" type="number" name="co_l4"
                                            value="0">
                                    </div>
                                </div>




                            </div>
                        </div>


                        <div class="ce">
                            <h6 class="mb-2">Cewek</h6>
                            <hr>
                            <div class="row">

                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> S</label>
                                        <input id="ce_s" class="form-control" type="number" name="ce_s"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> M</label>
                                        <input id="ce_m" class="form-control" type="number" name="ce_m"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> L</label>
                                        <input id="ce_l" class="form-control" type="number"
                                            name="ce_l"value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> XL</label>
                                        <input id="ce_xl" class="form-control" type="number" name="ce_xl"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> XXL</label>
                                        <input id="ce_xxl" class="form-control" type="number" name="ce_xxl"
                                            value="0">
                                    </div>
                                </div>
                            </div>


                            <h6 class="mb-2">Cewek Anak</h6>
                            <hr>
                            <div class="row">

                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> S</label>

                                        <input id="ce_l1" class="form-control" type="number" name="ce_l1"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> M</label>

                                        <input id=" " class="form-control" type="number" name="ce_l2"
                                            value="0">
                                    </div>
                                </div>

                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> L</label>

                                        <input id=" " class="form-control" type="number" name="ce_l3"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col-2 mr-1">

                                    <div class="form-group mb-4">
                                        <label for="" class="font-weight-bold"> XL</label>

                                        <input id=" " class="form-control" type="number" name="ce_l4"
                                            value="0">
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="form-group mt-2 mb-4">
                            <h6 class="mb-2" for=" ">Total pesanan</h6>
                            <input id="total-pesanan" class="form-control" type="number" value="0"
                                name="total_pesanan" required>
                            <label>Total pesanan akan mengikuti total jumlah ukuran yang anda masukkan</label>

                        </div>

                    </div>


                    <div class="col-12 px-xxl-5 px-xl-5 px-lg-5 my-3">
                        <h3 class="mb-2">Catatan</h3>
                        <textarea name="catatan" id="" class="form-control" cols="120" rows="5"></textarea>
                        <label>Isikan catatan tambahan untuk kami.</label>

                    </div>


                    <div class="col-12 px-xxl-5 px-xl-5 px-lg-5 my-3">
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="d-flex justify-content-md-center justify-content-sm-center">
                                    <img src="{{ asset('assets/images/sponsor/bajur.png') }}" alt="Awesome Image"
                                        class="small-image" style="width: 18rem; height: auto;">
                                </div>

                            </div>

                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="d-flex justify-content-md-center justify-content-sm-center">

                                    <img src="{{ asset('assets/images/sponsor/bajuk.png') }}" alt="Awesome Image"
                                        class="small-image" style="width: 18rem; height: auto;">
                                </div>
                            </div>
                        </div>

                        <div style="margin-left: -360px; margin-top: 50px;">
                            <span>Contoh Gambar Yang Diupload.</span>
                        </div>



                        <div class="col-12 px-xxl-5 px-xl-5 px-lg-5 my-3">
                            <h3 class="mb-2">Gambar</h3>

                            <input type="file" name="gambar_custom_design[]" accept="image/*" class="image-input" />
                            <br>
                            <label>Gambar maksimal 2 MB</label>

                            <img id="preview" src="#" alt="Preview Image"
                                style="display:none; max-width: 200px; margin-top: 10px;" />
                            <div id="newRowImage"></div>

                            <button id="addRow" type="button" class="btn btn-sm btn-secondary mb-4 mt-5">Tambah
                                Gambar</button>
                            <button id="removeRow" type="button"
                                class="btn btn-sm btn-secondary mb-4 mt-5">Kurangi</button>
                        </div>
                    </div>
                    {{-- Gambar --}}







                </div>
                <div class="d-grid px-5">
                    <button class="btn-one w-100">Pesan</button>

                </div>
            </form>

        </div>
    </section>



    <script type="text/javascript">
        // Function to preview image
        // Fungsi untuk preview gambar
        function previewImage(input, previewElement) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                    previewElement.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                previewElement.style.display = 'none';
                previewElement.src = '#';
            }
        }

        // Terapkan preview ke semua input gambar yang sudah ada
        document.querySelectorAll('.image-input').forEach(function(input) {
            input.addEventListener('change', function() {
                var preview = input.parentNode.querySelector(
                    'img'); // Mengambil img yang ada di dalam parent
                previewImage(input, preview);
            });
        });


        // Fungsi untuk menambahkan row baru
        document.getElementById('addRow').addEventListener('click', function() {
            var newInputRow = document.createElement('div');
            newInputRow.classList.add('input-row'); // Tambahkan class untuk identifikasi row
            newInputRow.innerHTML = `
        <div id="inputFormRow" class="mt-3">
            <input type="file" name="gambar_custom_design[]" accept="image/*" class="image-input" />
            <img src="#" alt="Preview Image" style="display:none; max-width: 200px; margin-top: 10px;" />
        </div>
    `;
            document.getElementById('newRowImage').appendChild(newInputRow);

            // Terapkan preview ke input baru
            var newInput = newInputRow.querySelector('.image-input');
            var newPreview = newInputRow.querySelector('img');
            newInput.addEventListener('change', function() {
                previewImage(newInput, newPreview);
            });
        });

        // Fungsi untuk menghapus row terakhir
        document.getElementById('removeRow').addEventListener('click', function() {
            var newRowImage = document.getElementById('newRowImage');
            var inputRows = newRowImage.getElementsByClassName('input-row');

            // Periksa apakah ada row yang bisa dihapus
            if (inputRows.length > 0) {
                newRowImage.removeChild(inputRows[inputRows.length - 1]); // Hapus row terakhir
            }
        });


        // Fungsi untuk menghitung total pesanan
        function calculateTotal() {
            let total = 0;

            // Ambil semua input ukuran cowok
            document.querySelectorAll('.co input[type="number"]').forEach(function(input) {
                total += parseInt(input.value) || 0;
            });

            // Ambil semua input ukuran cewek
            document.querySelectorAll('.ce input[type="number"]').forEach(function(input) {
                total += parseInt(input.value) || 0;
            });

            // Set total pesanan ke input total-pesanan
            document.getElementById('total-pesanan').value = total;
        }

        // Tambahkan event listener pada semua input ukuran cowok
        document.querySelectorAll('.co input[type="number"]').forEach(function(input) {
            input.addEventListener('input', calculateTotal);
        });

        // Tambahkan event listener pada semua input ukuran cewek
        document.querySelectorAll('.ce input[type="number"]').forEach(function(input) {
            input.addEventListener('input', calculateTotal);
        });
    </script>
@endsection
