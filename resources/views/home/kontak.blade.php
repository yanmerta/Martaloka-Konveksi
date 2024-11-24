@extends('home.home-layout')
@section('title', 'Kontak Kami')
@section('content')
    <section class="breadcrumb-area">
        <div class="breadcrumb-area-bg" style="background-image: url(assets/images/slider/jj.png);"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                            <h2>Kontak Kami</h2>
                        </div>
                        <div class="breadcrumb-menu" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li class="active">Kontak Kami</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->

    <section class="contact-details-style2-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="contact-details-style2-box">
                        <ul class="clearfix">
                            <li>
                                <div class="contact-details-style2-single">
                                    <div class="icon">
                                        <span class="icon-navigation"></span>
                                    </div>
                                    <div class="text">
                                        <h3>Lokasi Kami</h3>
                                        <p>Dusun Abian, Desa Banjar Tegeha, Kec Banjar, Buleleng, Bali</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact-details-style2-single">
                                    <div class="icon">
                                        <span class="icon-telephone"></span>
                                    </div>
                                    <div class="text">
                                        <h3>Kontak</h3>
                                        <p>Ph: <a href="tel:085847728414">085847728414</a> & Mail: <a
                                                href="mailto:martaloka@gmail.com">martaloka@gmail.com</a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <ul class="clearfix">
                            <li>
                                <div class="contact-details-style2-single">
                                    <div class="icon">
                                        <span class="icon-wall-clock"></span>
                                    </div>
                                    <div class="text">
                                        <h3>Jam Operasional</h3>
                                        <p>Senin-Sabtu: 09.00 - 17.00 (Minggu: Tutup)</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact-details-style2-single">
                                    <div class="icon">
                                        <span class="icon-share-3"></span>
                                    </div>
                                    <div class="text">
                                        <h3>Media Sosial</h3>
                                        <p class="social-links">
                                            <a href="#">Facebook</a>
                                            <a href="#">Instagram</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Contact Details Style2 Area-->

    <!--Start Main Contact Form Area-->
    <section class="main-contact-form-area">
        <div class="container">
            <div class="sec-title-style2 text-center" style="margin-top:-25px">
                <h2>Kirimkan Pertanyaan Anda Kepada Kami</h2>
            </div>

            <!-- Success Message -->
            @if (session('message'))
                <div class="alert alert-success text-center" role="alert" id="success-alert">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Error Message -->
            @if ($errors->any())
                <div class="alert alert-danger text-center" role="alert" id="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row margin0">
                <!-- Form Kontak -->
                <div class="col-md-6">
                    <div class="contact-form">
                        <form action="{{ route('kontak.store') }}" method="POST" onsubmit="return validateForm();">
                            @csrf <!-- Tambahkan csrf untuk keamanan -->

                            <div class="mb-2">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ old('nama') }}" placeholder="Masukkan Nama Anda" required>
                            </div>

                            <div class="mb-2">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon"
                                    value="{{ old('telepon') }}" placeholder="Masukkan No Telepon Anda" required>
                            </div>

                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Masukkan Email Anda" required>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <!-- Kolom Kosong untuk Sejajar -->
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea class="form-control" id="pesan" name="pesan" rows="3" placeholder="Masukkan Pesan Anda"
                                    required>{{ old('pesan') }}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div>
                            </div>

                            <!-- Action Buttons -->
                            <button type="submit" class="btn btn-primary btn-lg mt-1">
                                <i class="fas fa-paper-plane"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Map -->
                <div class="col-md-6">
                    <div class="border p-0 rounded mb-2" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31539.47482995904!2d114.9656228!3d-8.1986005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1833c90527d25%3A0xe408eb660d1a80fb!2sJl.+Banteng,+Banjar,+Kec.+Banjar,+Kabupaten+Buleleng,+Bali+81152!5e0!3m2!1sid!2sid!4v1687055968281!5m2!1sid!2sid"
                            width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hide Alerts After 5 seconds -->
    <script>
        setTimeout(function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
            if (errorAlert) {
                errorAlert.style.display = 'none';
            }
        }, 5000); // 5000 ms = 5 detik
    </script>

    <!-- reCAPTCHA validation -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function validateForm() {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                alert("Please check reCAPTCHA verification.");
                return false;
            } else {
                return true;
            }
        }
    </script>
@endsection
