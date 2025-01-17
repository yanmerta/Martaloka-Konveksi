@extends('home.home-layout')
@section('content')
    <div class="">
        <section class="main-slider style1 nav-style2">
            <div class="slider-box">
                <!-- Banner Carousel -->
                <div class="banner-carousel owl-theme owl-carousel">

                    <!-- Slide -->
                    <div class="slide">
                        <div class="image-layer" style="background-image:url({{ asset('assets/images/slider/jahit.webp') }})">
                        </div>
                        <div class="auto-container">
                            <div class="content">
                                <div class="big-title">
                                    <h2>Selamat Datang di
                                        Martaloka Konveksi
                                    </h2>
                                </div>
                                <style>
                                    .big-title h2 {
                                        white-space: pre-line;
                                        /* Membuat line breaks dari spasi/enter di HTML terlihat */
                                    }
                                </style>
                                <div class="text">
                                    <p>Konveksi kami menawarkan solusi pembuatan berbagai pakaian</p>
                                </div>
                                <div class="btns-box">
                                    <a class="btn-one" href="{{ route('home.createDesign') }}">
                                        <span class="txt">
                                            Pesan
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide -->
                    <div class="slide">
                        <div class="image-layer"
                            style="background-image:url({{ asset('assets/images/slider/deret.jfif') }})">
                        </div>
                        <div class="auto-container">
                            <div class="content middle text-center">
                                <div class="big-title">
                                    <h2>Kualitas Tak Tertandingi Harga Terjangkau</h2>
                                </div>
                                <div class="text">
                                    <p>Mewujudkan Inspirasi Mode Anda Dengan Sentuhan Konveksi Profesional</p>
                                </div>
                                <div class="btns-box">
                                    <a class="btn-one" href="{{ route('home.createDesign') }}">
                                        <span class="txt">
                                            Pesan
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide -->
                    <div class="slide">
                        <div class="image-layer"
                            style="background-image:url({{ asset('assets/images/slider/Sablon.png') }})">
                        </div>
                        <div class="auto-container">
                            <div class="content">
                                <div class="big-title">
                                    <h2>Gaya Anda
                                        Karya Kami
                                    </h2>
                                </div>
                                <style>
                                    .big-title h2 {
                                        white-space: pre-line;
                                    }
                                </style>
                                <div class="text">
                                    <p>Tingkatkan Penampilan Anda dengan Pilihan yang Luar Biasa</p>
                                </div>
                                <div class="btns-box">
                                    <a class="btn-one" href="{{ route('home.createDesign') }}">
                                        <span class="txt">
                                            Pesan
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="academics-overview-style1-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="academics-overview-style1-content">
                            <div class="academics-overview-style1-content__shape"
                                style="background-image:url({{ asset('assets/images/slider/kaos.jpg') }})"> </div>
                            <div class="text-box">
                                <div class="sec-title">
                                    <h2>Martaloka Konveksi</h2>
                                </div>
                                <div class="text">
                                    <p class="text-justify">Martaloka konveksi hadir untuk membantu Anda dalam memiliki kaos
                                        terbaik untuk berbagai aktivitas dan kegiatan. Kami memproduksi berbagai jenis kaos
                                        seperti kaos event, kaos promosi perusahaan, kaos klub hobi, kaos fans, dan kaos
                                        partai
                                        dengan kualitas yang terjaga. Dengan melakukan seluruh proses produksi secara
                                        mandiri,
                                        kami dapat memotong biaya dan waktu sehingga konsumen kami dapat menerima manfaat
                                        layanan kami sebagai “Tangan Pertama Anda”. Dapatkan produk kaos berkualitas dengan
                                        harga yang hemat dan hemat waktu hanya di martaloka-konveksi.com</p>
                                </div>
                            </div>
                            <div class="academics-overview-style1-img-box"
                                style="background-image:url({{ asset('assets/images/slider/5.jpg') }})"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="departments-area" id="pilihAska">
            <div class="container">
                <div class="sec-title text-center">
                    <h2>Keunggulan Martaloka Konveksi</h2>
                    <div class="sub-title">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-3">
                        <div class="single-departments-box marginbottom text-center wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="0.1s">
                            <div class="icon">
                                <img style="height: 85px;" src="{{ asset('assets/images/icon/11.png') }}" alt="">
                            </div>
                            <div class="">
                                <h2>Spesialis Kaos</h2>
                                <div class="text">
                                    <p class="text-justify">Sudah lebih dari 5 tahun lamanya kami fokus di spesialis kaos.
                                        Dengan fokus pada produksi kaos, kami menghasilkan produk berkualitas tinggi yang
                                        dirancang khusus untuk kebutuhan Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-departments-box text-center wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="0.2s">
                            <div class="icon">
                                <img style="height: 85px;" src="{{ asset('assets/images/icon/13.png') }}" alt="">
                            </div>
                            <div class="">
                                <h2>Tangan Pertama</h2>
                                <div class="text">
                                    <p class="text-justify">Kami memproduksi kaos secara langsung, tanpa melalui perantara,
                                        sehingga menghasilkan produk yang berkualitas, harga terjangkau dan tepat waktu yang
                                        sesuai dengan keinginan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6">
                        <div class="departments-img-box"
                            style="background-image: url({{ asset('assets/images/slider/polo.jpg') }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-3">
                        <div class="single-departments-box marginbottom text-center wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.1s">
                            <div class="icon">
                                <img style="height: 85px;" src="{{ asset('assets/images/icon/12.png') }}" alt="">
                            </div>
                            <div class="">
                                <h2>Kapasitas Besar</h2>
                                <div class="text">
                                    <p class="text-justify">Dengan kapasitas produksi yang besar, yaitu mencapai 1000 pcs
                                        per
                                        bulan, Pabrik Kaos kami mampu memenuhi pesanan dalam jumlah besar untuk wilayah Bali
                                        tanpa mengorbankan kualitas.</p>
                                </div>
                            </div>
                        </div>

                        <div class="single-departments-box text-center wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.2s">
                            <div class="icon">
                                <img style="height: 85px;" src="{{ asset('assets/images/icon/14.png') }}" alt="">
                            </div>
                            <div class="">
                                <h2>Kualitas Terjamin</h2>
                                <div class="text">
                                    <p class="text-justify">Kami hanya menggunakan bahan berkualitas tinggi dan team
                                        produksi
                                        handal dalam setiap tahap produksi, sehingga Anda dapat yakin bahwa kaos Anda akan
                                        bertahan lama dan tetap nyaman dipakai.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>  

        <section class="academy-working-process-area">
            <div class="container">
                <div class="sec-title-style3 text-center">
                    <h2><span>Cara Mendesain</span> Custom</h2>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="academy-working-process__content-outer">
                            <div class="dotted-line">
                                <img src="assets/images/step/dotted-line.png" alt="">
                            </div>
                            <ul class="academy-working-process__content">
                                <li>
                                    <div class="academy-working-process-single-box" onclick="showDetail(1)">
                                        <div class="icon">
                                            <span class="icon-coder-1"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Step 01</h3>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="academy-working-process-single-box" onclick="showDetail(2)">
                                        <div class="icon">
                                            <span class="icon-reading-1"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Step 02</h3>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="academy-working-process-single-box" onclick="showDetail(3)">
                                        <div class="icon">
                                            <span class="icon-credit-card-1"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Step 03</h3>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="academy-working-process-single-box" onclick="showDetail(4)">
                                        <div class="icon">
                                            <span class="icon-online-store-1"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Step 04</h3>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="academy-working-process-single-box" onclick="showDetail(5)">
                                        <div class="icon">
                                            <span class="icon-diploma-1"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Step 05</h3>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Modals for each step -->
        <div class="modals-container">
            <div id="step-modal-template" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div class="modal-navigation">
                        <button class="prev" onclick="navigateStep(-1)">&#x2B05;</button>
                        <button class="next" onclick="navigateStep(1)">&#x27A1;</button>
                    </div>
                    <h2 id="modal-title"></h2>
                    <div class="modal-body">
                        <img id="modal-image" src="" alt="Step Image">
                        <p id="modal-description"></p>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
        .academy-working-process-single-box {
            cursor: pointer;
            position: relative;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            text-align: center;
            max-height: 80%;
            overflow-y: auto;
        }
        
        .modal-content img {
            max-width: 80%;
            height: auto;
            margin-bottom: 15px;
        }
        
        .modal-body {
            text-align: center;
        }
        
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #000;
        }
        
        .modal-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px; /* Jarak dari atas */
            position: relative;
        }
        
        .modal-navigation button {
            background: none;
            border: none;
            font-size: 36px; /* Memperbesar ukuran font */
            cursor: pointer;
            color: #ff0000; /* Warna biru yang menarik */
            transition: color 0.3s ease;
        }
        
        .modal-navigation button:hover {
            color: #ff0000; /* Warna lebih gelap saat hover */
        }
        </style>
        
        <script>
        const steps = [
            {
                title: "Step 01: Tombol Mendesain Baju",
                image: "./assets/images/step/1.png",
                description: "Untuk memulai proses desain baju di Martaloka, buka halaman utama website dan cari tombol Mendesain Baju yang terletak di bawah teks Kreasikan Kaos Anda di sini pada bagian kiri halaman, seperti yang terlihat pada gambar di atas. Klik tombol tersebut, dan Anda akan diarahkan ke halaman khusus untuk mendesain baju, di mana Anda dapat mengkustomisasi desain, memilih warna, serta menambahkan teks dan logo sesuai keinginan."
            },
            {
                title: "Step 02: Tutorial Mendesain",
                image: "./assets/images/step/2.png",
                description: "Setelah Anda mengklik tombol Mendesain Baju, akan muncul pop-up seperti yang ditunjukkan pada gambar di atas. Pop-up ini menyediakan tiga opsi: tombol Back untuk kembali ke langkah sebelumnya, tombol Next untuk melanjutkan ke langkah berikutnya, dan tombol Play Video Tutorial berwarna kuning untuk menonton video panduan yang membantu Anda memahami proses desain baju dengan lebih detail. Pilih opsi sesuai kebutuhan Anda untuk melanjutkan."
            },
            {
                title: "Step 03: Halaman Custom Desain",
                image: "assets/images/step/3.png",
                description: "Pada tahap ini, Anda akan diarahkan ke halaman custom desain seperti pada gambar di atas. Di sini, Anda dapat memilih kategori baju yang akan digunakan melalui menu dropdown di sebelah tulisan Man t-shirt dan mengganti warna baju sesuai keinginan dengan memilih warna yang tersedia. Selain itu, Anda juga dapat mengunggah desain sendiri dengan mengklik ikon pensil di bagian Upload your design. Setelah selesai, Anda dapat melanjutkan proses desain atau mengekspor hasilnya."
            },
            {
                title: "Step 04: Upload Gambar",
                image: "assets/images/step/4.png",
                description: "Untuk menyesuaikan posisi gambar seperti pada gambar di atas, langkah-langkahnya adalah sebagai berikut: Gunakan fitur pemindahan gambar dengan cara mengklik dan menyeret gambar ke posisi yang diinginkan di dalam area desain (ditandai oleh kotak biru). Pastikan gambar berada di tengah atau sesuai dengan preferensi Anda menggunakan panduan grid. Setelah posisi gambar dirasa sesuai, klik tombol Save yang terletak di pojok kanan bawah untuk menyimpan perubahan yang telah Anda lakukan."
            },
            {
                title: "Step 05: Download",
                image: "assets/images/step/5.png",
                description: "Setelah selesai mendesain, Anda dapat mengunduh gambar dengan mengklik tombol Export yang terletak di bagian kanan bawah layar, seperti yang ditunjukkan pada gambar di atas. Pastikan desain Anda sudah sesuai sebelum mengklik tombol ini untuk menyimpan hasil desain dalam format yang diinginkan."
            }
        ];
        
        let currentStep = 0;
        
        function showDetail(stepIndex) {
            currentStep = stepIndex - 1;
            updateModalContent();
            document.getElementById("step-modal-template").style.display = "flex";
        }
        
        function closeModal() {
            document.getElementById("step-modal-template").style.display = "none";
        }
        
        function navigateStep(direction) {
            currentStep += direction;
            if (currentStep < 0) currentStep = 0;
            if (currentStep >= steps.length) currentStep = steps.length - 1;
            updateModalContent();
        }
        
        function updateModalContent() {
            const step = steps[currentStep];
            document.getElementById("modal-title").textContent = step.title;
            document.getElementById("modal-image").src = step.image;
            document.getElementById("modal-description").textContent = step.description;
        
            document.querySelector(".prev").style.display = currentStep === 0 ? "none" : "inline-block";
            document.querySelector(".next").style.display = currentStep === steps.length - 1 ? "none" : "inline-block";
        }
        
        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById("step-modal-template");
            if (event.target == modal) {
                closeModal();
            }
        };
        </script>
        

        <section class="academy-slogan-area">
            <div class="academy-slogan-middle-content">
                <div class="academy-slogan-middle-content__bg"
                    style="background-image: url({{ asset('assets/images/slider/polo.jpg') }});"></div>
                <div class="banner-logo-box">
                    <a href="index-3.html">
                        <img style="margin-top: -30px" src="{{ asset('assets/images/logo1.png') }}" alt="Awesome Logo" title="">
                    </a>
                </div>
            </div>
        
            <div class="auto-container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="academy-slogan-content-one">
                            <div class="academy-slogan-content-one__bg"
                                style="background-image: url({{ asset('assets/images/slider/5.jpg') }});"></div>
                            <div class="academy-slogan-content-one__inner text-center">
                                <div class="sec-title-style3">
                                    <div class="sub-title"></div>
                                    <h2><span>Kreasikan Kaos Anda<br>di sini</span><br></h2>
                                </div>
                                <div class="btns-box">
                                    <!-- Tombol Desain untuk menampilkan video container -->
                                    <a class="btn-one btn-one--style4" href="#" onclick="showVideoContainer(event)">
                                        <span class="txt">
                                            <i class="icon-right-arrow-1"></i>
                                            Mendesain Baju
                                        </span>
                                    </a>
                                </div>
                                <div class="btns-box">
                                    <a class="btn-one btn-one--style4 btn-wide" href="assets/pdf/panduan desain.pdf" target="PanduanDesainPDF">
                                        <span class="txt">
                                            <i class="icon-right-arrow-1"></i>
                                            Panduan Desain
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-xl-6">
                        <div class="academy-slogan-content-one academy-slogan-content-one--style2">
                            <div class="academy-slogan-content-one__bg"
                                style="background-image: url({{ asset('assets/images/slider/5.jpg') }});"></div>
                            <div class="academy-slogan-content-one__inner text-center">
                                <div class="sec-title-style3">
                                    <div class="sub-title"></div>
                                    <h2><span>Ayo Pesan jenis Pakaian<br>Anda Sekarang</span><br></h2>
                                </div>
                                <div class="btns-box">
                                    <a class="btn-one btn-one--style4" href="{{ route('home.createDesign') }}">
                                        <span class="txt">
                                            <i class="icon-right-arrow-1"></i>
                                            Pesan Custom
                                        </span>
                                    </a>
                                </div>
                                <div class="btns-box">
                                    <a class="btn-one btn-one--style4 btn-wide" href="assets/pdf/panduan desain.pdf" target="PanduanDesainPDF">
                                        <span class="txt">
                                            <i class="icon-right-arrow-1"></i>
                                            Panduan Pemesanan
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Video Container (disembunyikan di awal) -->
            <div id="videoContainer" class="video-container" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); z-index: 1000;">
                <button class="close-video" onclick="closeVideo()" style="position: absolute; top: 10px; right: 20px; font-size: 24px; color: white; background: none; border: none; cursor: pointer;">×</button>
                <div class="video-wrapper" style="position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; max-width: 800px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <video id="assetVideo" src="assets/vidio/vidio_desain.mp4" controls style="display: none; width: 100%; height: auto; border-radius: 8px;">
                        Your browser does not support the video tag.
                    </video>
                    <div class="video-controls" style="margin-top: 10px; text-align: center;">
                        <button class="video-back-btn" onclick="backToPage()" style="margin-right: 10px; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Back</button>
                        <button class="video-next-btn" onclick="skipToStudio()" style="margin-left: 10px; padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">Next</button>
                    </div>
                    <div class="btns-box" style="margin-top: 20px; text-align: center;">
                        <!-- Tombol untuk memutar video tutorial -->
                        <button class="btn-one btn-one--style4" onclick="playVideo()" style="padding: 10px 20px; background-color: #ffc107; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            <span class="txt">
                                <i class="icon-right-arrow-1"></i>
                                Play Video Tutorial
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        
        <script>
            function showVideoContainer(event) {
                event.preventDefault();
                const videoContainer = document.getElementById('videoContainer');
                const video = document.getElementById('assetVideo');
                video.pause();
                video.currentTime = 0;
                videoContainer.style.display = 'block';
            }
        
            function closeVideo() {
                const videoContainer = document.getElementById('videoContainer');
                const video = document.getElementById('assetVideo');
                video.pause();
                video.style.display = 'none';
                videoContainer.style.display = 'none';
            }
        
            function playVideo() {
                const video = document.getElementById('assetVideo');
                video.style.display = 'block';
                video.play();
            }
        
            function backToPage() {
                const videoContainer = document.getElementById('videoContainer');
                const video = document.getElementById('assetVideo');
                video.pause();
                video.currentTime = 0; // Reset video playback
                videoContainer.style.display = 'none';
                window.location.href = '/'; // Redirect to the homepage
            }
        
            function skipToStudio() {
                const video = document.getElementById('assetVideo');
                video.pause(); // Pause the video before navigating
                window.location.href = 'https://studio.morflax.com/clothing-mockups/create?element=t-shirt-man'; // Navigate to Morvlaf Studio
            }
        </script>
        

        <section class="partner-style2-area">
            <div class="container">
                <div class="sec-title-style3 text-center">
                    <div class="sub-title">
                    </div>
                    <h2 style="margin-top: -20px">TELAH DIPERCAYA OLEH :</h2>
                </div>

                <div class="row">
                    <!--Start Single Partner Logo Box-->
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="single-partner-logo-box-style2">
                            <a href="#"><img src="{{ asset('assets/images/sponsor/1.png') }}"
                                    alt="Awesome Image"></a>
                        </div>
                    </div>
                    <!--End Single Partner Logo Box-->
                    <!--Start Single Partner Logo Box-->
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="single-partner-logo-box-style2">
                            <a href="#"><img src="{{ asset('assets/images/sponsor/2.png') }}"
                                    alt="Awesome Image"></a>
                        </div>
                    </div>
                    <!--End Single Partner Logo Box-->
                    <!--Start Single Partner Logo Box-->
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="single-partner-logo-box-style2">
                            <a href="#"><img src="{{ asset('assets/images/sponsor/3.png') }}"
                                    alt="Awesome Image"></a>
                        </div>
                    </div>
                    <!--End Single Partner Logo Box-->
                    <!--Start Single Partner Logo Box-->
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="single-partner-logo-box-style2">
                            <a href="#"><img src="{{ asset('assets/images/sponsor/4.png') }}"
                                    alt="Awesome Image"></a>
                        </div>
                    </div>
                    <!--End Single Partner Logo Box-->
                    <!--Start Single Partner Logo Box-->
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="single-partner-logo-box-style2">
                            <a href="#"><img src="{{ asset('assets/images/sponsor/5.png') }}"
                                    alt="Awesome Image"></a>
                        </div>
                    </div>
                    <!--End Single Partner Logo Box-->
                    <!--Start Single Partner Logo Box-->
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="single-partner-logo-box-style2">
                            <a href="#"><img src="{{ asset('assets/images/sponsor/6.png') }}"
                                    alt="Awesome Image"></a>
                        </div>
                    </div>
                    <!--End Single Partner Logo Box-->
                </div>
            </div>
        </section>

    </div>
@endsection
