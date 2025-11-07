<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TuNetic - Buang Sampah Tanpa Ribet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family='Red Hat Text':wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        #tps {
            scroll-margin-top: 100px;
            /* Sesuaikan dengan tinggi navbar jika fixed */
        }

        /* Jadwal section styles */
        #jadwal h2,
        #jadwal h6 {
            font-family: '' Red Hat Text'', sans-serif;
            font-weight: 700;
        }

        #jadwal p,
        #jadwal small {
            font-family: 'Red Hat Text', sans-serif;
        }

        #jadwal .card {
            border-radius: 12px;
            border: none;
            transition: transform 0.3s ease;
        }

        #jadwal .card:hover {
            transform: translateY(-5px);
        }

        /* Blue horizontal line at the bottom of jadwal section */
        #jadwal::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .search-box .form-control:focus {
            border-color: #299E63;
            box-shadow: 0 0 0 0.2rem rgba(41, 158, 99, 0.25);
        }

        .article-item {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ChatBot Styles */
        .chatbot-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #299E63, #24CE78);
            border: none;
            border-radius: 50%;
            box-shadow: 0 4px 20px rgba(41, 158, 99, 0.3);
            z-index: 10000;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chatbot-toggle:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(41, 158, 99, 0.4);
        }

        .chatbot-toggle i {
            color: white;
            font-size: 24px;
        }

        .chat-modal {
            z-index: 10001 !important;
        }

        .chat-modal .modal-backdrop {
            display: none !important;
        }

        .chat-modal .modal-dialog {
            position: fixed;
            bottom: 100px;
            right: 30px;
            margin: 0;
            transform: none;
            max-width: 400px;
            width: 400px;
            z-index: 10002 !important;
        }

        .chat-modal .modal-content {
            border-radius: 15px;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .chat-header {
            background: linear-gradient(135deg, #299E63, #24CE78);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .chat-body {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            background: #f8f9fa;
        }

        .message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .message.user {
            justify-content: flex-end;
        }

        .message-content {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 18px;
            word-wrap: break-word;
        }

        .message.user .message-content {
            background: #299E63;
            color: white;
            border-bottom-right-radius: 5px;
        }

        .message.bot .message-content {
            background: white;
            color: #333;
            border: 1px solid #e9ecef;
            border-bottom-left-radius: 5px;
        }

        .chat-input-area {
            padding: 20px;
            background: white;
            border-top: 1px solid #e9ecef;
        }

        .typing-indicator {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 18px;
            border-bottom-left-radius: 5px;
            max-width: 70%;
        }

        .typing-dots {
            display: flex;
            gap: 3px;
        }

        .typing-dots span {
            width: 8px;
            height: 8px;
            background: #999;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            60%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-10px);
            }
        }

        /* Responsive untuk modal */
        @media (max-width: 768px) {
            .chat-modal .modal-dialog {
                position: fixed;
                bottom: 100px;
                right: 10px;
                left: 10px;
                width: auto;
                max-width: none;
                z-index: 10002 !important;
            }

            .chatbot-toggle {
                bottom: 20px;
                right: 20px;
                width: 55px;
                height: 55px;
                z-index: 10000 !important;
            }

            .chatbot-toggle i {
                font-size: 20px;
            }

            /* Perbaikan untuk hero section di mobile */
            .hero .col-md-6 img {
                max-width: 80% !important;
                transform: translateY(10px) !important;
            }
        }

        @media (min-width: 769px) {
            .chat-modal .modal-dialog {
                position: fixed;
                bottom: 100px;
                right: 30px;
                margin: 0;
                transform: none;
                max-width: 400px;
                width: 400px;
                z-index: 10002 !important;
            }
        }

        /* Pastikan semua elemen tidak menutupi chatbot */
        .hero img {
            position: relative;
            z-index: 1 !important;
        }

        .position-absolute {
            z-index: auto !important;
        }

        .position-relative {
            z-index: auto !important;
        }

        /* Override any high z-index that might interfere */
        * {
            z-index: auto;
        }

        .chatbot-toggle,
        .chat-modal,
        .chat-modal * {
            z-index: 10000 !important;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-1">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('assets/images/logowarna2.png') }}" alt="TuRetic Logo" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="font-family: Red Hat Text, sans-serif; font-weight: bolder;">
                                <a class="nav-link" style="font-weight: 600;" href="#tentang-kami">Tentang Kami</a>
                            </li>
                            <li class="nav-item" style="font-family: Red Hat Text, sans-serif;">
                                <a class="nav-link" style="font-weight: 600;" href="#layanan">Layanan</a>
                            </li>
                            <li class="nav-item" style="font-family: Red Hat Text, sans-serif;">
                                <a class="nav-link" style="font-weight: 600;" href="#tps">TPS</a>
                            </li>
                            <li class="nav-item" style="font-family: Red Hat Text, sans-serif;">
                                <a class="nav-link" style="font-weight: 600;" href="#jadwal">Jadwal</a>
                            </li>
                            <li class="nav-item" style="font-family: Red Hat Text, sans-serif;">
                                <a class="nav-link" style="font-weight: 600;" href="#edukasi">Edukasi</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="login" class="auth-btn sign-in me-2">Sign in</a>
                    <a href="login" class="auth-btn sign-up">Sign up</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero bg-success text-white position-relative overflow-hidden">
        <!-- Siluet Logo di Background -->
        <div class="position-absolute start-0 top-50 translate-middle-y opacity-7" style="z-index: 1;">
            <img src="{{ asset('assets/images/logopalsu.png') }}" alt="Siluet Logo" class="img-fluid"
                style="max-width: 300px;">
        </div>

        <div class="container position-relative pt-5" style="z-index: 2; max-width: 100%; overflow-x: hidden;">
            <div class="row align-items-center">
                <!-- Teks Kiri -->
                <div class="col-md-6" style="padding-left: 40px; padding-top: 100px;">
                    <h1 class="display-4 fw-bold" style="font-family: 'Red Hat Text'; font-size: 4rem;">
                        Buang Sampah <br /> Tanpa Ribet
                    </h1>

                    <p class="lead mt-4" style="font-size: 2rem; font-family: 'Red Hat Text', sans-serif;">#Small Steps,
                        Big Impact</p>
                    <a href="login" class="btn btn-warning px-5 py-3 mt-3 start-now-btn">Mulai Sekarang</a>
                </div>

                <!-- Gambar Kanan -->
                <div class="col-md-6 text-end d-flex justify-content-end align-items-end" style="overflow: hidden;">
                    <img src="{{ asset('assets/images/iconpetugas1.png') }}" alt="Petugas Sampah" class="img-fluid"
                        style="max-width: 90%; transform: translateY(20px); z-index: 1;">
                </div>
            </div>
        </div>
    </section>

    <!-- Pengelolaan Sampah Section -->
    <section class="py-5" id="tentang-kami">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('assets/images/tempatsampah.png') }}" alt="Pengelolaan Sampah" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2 class="mb-4" style="font-weight: 650; font-family: 'Red Hat Text', sans-serif;">
                        Mengelola Sampah Mudah untuk Kota Lestari
                    </h2>

                    <p class="font-redhat">TuNetic membantu masyarakat mengelola sampah dengan mudah dan bertanggung
                        jawab. Setiap langkah kecil bisa berdampak besar bagi lingkungan.</p>

                    <div class="stats-container mt-4">
                        <div class="stats-card">
                            <div class="stat-item">
                                <div class="stat-label">Jumlah Sampah</div>
                                <div class="stat-value" style="font-family: 'Red Hat Text', sans-serif;">1jt Kg+</div>
                            </div>
                            <div class="stats-divider"></div>
                            <div class="stat-item">
                                <div class="stat-label">TPS Aktif</div>
                                <div class="stat-value" style="font-family: 'Red Hat Text', sans-serif;">20</div>
                            </div>
                            <div class="stats-divider"></div>
                            <div class="stat-item">
                                <div class="stat-label">Pengguna</div>
                                <div class="stat-value" style="font-family: 'Red Hat Text', sans-serif;">100</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section class="py-5 mb-5 bg-white font-redhat" id="layanan">
        <div class="container">
            <h2 class="fw-semibold mb-2">Layanan</h2>
            <p class="mb-5">Lihat Layanan yang Tersedia di TuNetic</p>

            <div class="row g-5">
                <!-- Jemput Sampah -->
                <div class="col-md-5 text-center">
                    <h3 class="fw-semibold mb-4">Jemput Sampah</h3>
                    <div class="service-image mb-4">
                        <img src="{{ asset('assets/images/truck1.png') }}" alt="Jemput Sampah" class="img-fluid"
                            style="max-height: 200px;">
                    </div>
                    <p class="text-center px-3">
                        Jemput Sampah adalah layanan penjemputan sampah yang telah terjadwal untuk setiap TPS yang ada
                        di Kecamatan Tembalang.
                    </p>
                </div>

                <!-- Garis Pemisah -->
                <div class="col-md-2 d-none d-md-flex justify-content-center">
                    <div class="vertical-divider"></div>
                </div>

                <!-- Lapor Sampah -->
                <div class="col-md-5 text-center">
                    <h3 class="fw-semibold mb-4">Lapor Sampah</h3>
                    <div class="service-image mb-4">
                        <img src="{{ asset('assets/images/petugas2.png') }}" alt="Lapor Sampah" class="img-fluid"
                            style="max-height: 200px;">
                    </div>
                    <p class="text-center px-3">
                        Lapor Sampah memudahkanmu melaporkan sampah liar dengan foto dan lokasi untuk ditindaklanjuti.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- TPS Section -->
    <section id="tps" class="position-relative overflow-hidden">
        <div class="tps-wrapper text-white position-relative z-1">
            <!-- Header -->
            <div class="tps-header text-start">
                <h2 class="mb-2" style="font-family: 'Red Hat Text', sans-serif; font-weight: 600;">TPS</h2>
                <p class="mb-4" style="font-family: 'Red Hat Text', sans-serif;">Temukan Lokasi TPS Terdekat</p>
            </div>

            <!-- TPS Cards -->
            <div class="row g-4">
                <div class="col-md-4 col-sm-6">
                    <div class="tps-card">
                        <img src="{{ asset('assets/images/sampahtps.png') }}" alt="TPS Icon" class="tps-icon">
                        <p class="tps-title">TPS Tulus Harapan</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="tps-card">
                        <img src="{{ asset('assets/images/sampahtps.png') }}" alt="TPS Icon" class="tps-icon">
                        <p class="tps-title">TPS Ketileng Atas</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="tps-card">
                        <img src="{{ asset('assets/images/sampahtps.png') }}" alt="TPS Icon" class="tps-icon">
                        <p class="tps-title">TPS Ketileng Bawah</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="tps-card">
                        <img src="{{ asset('assets/images/sampahtps.png') }}" alt="TPS Icon" class="tps-icon">
                        <p class="tps-title">TPS PSIS</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="tps-card">
                        <img src="{{ asset('assets/images/sampahtps.png') }}" alt="TPS Icon" class="tps-icon">
                        <p class="tps-title">TPS Wanamukti</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="tps-card">
                        <img src="{{ asset('assets/images/sampahtps.png') }}" alt="TPS Icon" class="tps-icon">
                        <p class="tps-title">TPS Perumahan Intan</p>
                    </div>
                </div>
            </div>

            <!-- Lihat Semua -->
            <a href="#" class="lihat-semua">Lihat Semua →</a>
        </div>

        <!-- Jadwal Section -->
        <section class="py-5 position-relative" id="jadwal">
            <div class="container">
                <h2 class="fw-semibold mb-2" style="font-family: 'Red Hat Text', sans-serif;">Jadwal</h2>
                <p class="mb-4" style="font-family: 'Red Hat Text', sans-serif;">Lihat dan Pantau Jadwal Penjemputan
                    Sampah</p>

                <div class="row align-items-center">
                    <div class="col-md-4">
                        <!-- Worker with trash bags image -->
                        <img src="{{ asset('assets/images/petugas1.png') }}" alt="Petugas Sampah" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="row g-3">
                            <!-- Senin -->
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 mb-3"
                                    style="background-color: #299E63; min-height: 70px;">
                                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-white"
                                            style="font-family: 'Red Hat Text', sans-serif; width: 100px;">Senin</h6>
                                        <div class="text-end" style="width: 150px;">
                                            <small class="text-white"
                                                style="font-family: 'Red Hat Text', sans-serif;">
                                                Pagi, 05:00 - 10:00<br>
                                                Sore, 16:00 - 20:00
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Jumat -->
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 mb-3"
                                    style="background-color: #299E63; min-height: 70px;">
                                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-white"
                                            style="font-family: 'Red Hat Text', sans-serif; width: 100px;">Jumat</h6>
                                        <div class="text-end" style="width: 150px;">
                                            <small class="text-white"
                                                style="font-family: 'Red Hat Text', sans-serif;">
                                                Pagi, 05:00 - 10:00<br>
                                                Sore, 16:00 - 20:00
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Selasa -->
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 mb-3"
                                    style="background-color: #299E63; min-height: 70px;">
                                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-white"
                                            style="font-family: 'Red Hat Text', sans-serif; width: 100px;">Selasa</h6>
                                        <div class="text-end" style="width: 150px;">
                                            <small class="text-white"
                                                style="font-family: 'Red Hat Text', sans-serif;">
                                                Pagi, 05:00 - 10:00
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sabtu -->
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 mb-3"
                                    style="background-color: #299E63; min-height: 70px;">
                                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-white"
                                            style="font-family: 'Red Hat Text', sans-serif; width: 100px;">Sabtu</h6>
                                        <div class="text-end" style="width: 150px;">
                                            <small class="text-white"
                                                style="font-family: 'Red Hat Text', sans-serif;">
                                                Pagi, 05:00 - 10:00
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rabu -->
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 mb-3"
                                    style="background-color: #299E63; min-height: 70px;">
                                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-white"
                                            style="font-family: 'Red Hat Text', sans-serif; width: 100px;">Rabu</h6>
                                        <div class="text-end" style="width: 150px;">
                                            <small class="text-white"
                                                style="font-family: 'Red Hat Text', sans-serif;">
                                                Pagi, 05:00 - 10:00<br>
                                                Sore, 16:00 - 20:00
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Minggu -->
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 mb-3"
                                    style="background-color: #299E63; min-height: 70px;">
                                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-white"
                                            style="font-family: 'Red Hat Text', sans-serif; width: 100px;">Minggu</h6>
                                        <div class="text-end" style="width: 150px;">
                                            <small class="text-white"
                                                style="font-family: 'Red Hat Text', sans-serif;">
                                                Pagi, 07:00 - 12:00
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kamis -->
                            <div class="col-md-6">
                                <div class="card border-0 rounded-4 mb-3"
                                    style="background-color: #299E63; min-height: 70px;">
                                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-white"
                                            style="font-family: 'Red Hat Text', sans-serif; width: 100px;">Kamis</h6>
                                        <div class="text-end" style="width: 150px;">
                                            <small class="text-white"
                                                style="font-family: 'Red Hat Text', sans-serif;">
                                                Pagi, 05:00 - 10:00
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gambar Sampah di Kanan Bawah -->
            <div class="position-absolute bottom-0 end-0" style="z-index: 1; max-width: 200px; overflow: hidden;">
                <img src="{{ asset('assets/images/sampah1.png') }}" alt="Sampah" class="img-fluid">
            </div>
        </section>

        <!-- Edukasi Section - Dynamic Version -->
        <section class="py-5" id="edukasi">
            <div class="container">
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h2 class="fw-semibold mb-3" style="font-family: 'Red Hat Text', sans-serif;">Edukasi</h2>
                        <p class="mb-4" style="font-family: 'Red Hat Text', sans-serif; font-weight: 450;">
                            Baca Artikel Tentang Pengelolaan Sampah, Lingkungan, dan Gaya Hidup Berkelanjutan.
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-outline-success">
                            Lihat Semua Artikel <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Search Box (Optional) -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <form action="{{ route('dashboard.artikel.search') }}" method="GET" class="search-box">
                            <div class="position-relative">
                                <input type="text" name="q" class="form-control"
                                    placeholder="Cari artikel..." value="{{ request('q') }}"
                                    style="padding-left: 45px; border-radius: 25px; border: 2px solid #e9ecef;">
                                <i class="fas fa-search position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Articles Grid -->
                <div class="row" id="articles-container">
                    @forelse($artikels ?? [] as $artikel)
                        <div class="col-md-6 mb-4 article-item">
                            <div class="card border-0 shadow-sm h-100 article-card">
                                <div class="row g-0">
                                    <!-- Article Image -->
                                    <div class="col-md-5">
                                        @if ($artikel->gambar)
                                            <img src="{{ asset('storage/' . $artikel->gambar) }}"
                                                class="img-fluid rounded-start h-100"
                                                alt="{{ $artikel->judul_artikel }}" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="bg-light d-flex align-items-center justify-content-center h-100 rounded-start">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Article Content -->
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <!-- Date -->
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="far fa-calendar-alt me-2 text-muted"></i>
                                                <small class="text-muted"
                                                    style="font-family: 'Red Hat Text', sans-serif;">
                                                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                                </small>
                                            </div>

                                            <!-- Title -->
                                            <h5 class="card-title"
                                                style="font-family: 'Red Hat Text', sans-serif; font-weight: 600;">
                                                {{ Str::limit($artikel->judul_artikel, 60) }}
                                            </h5>

                                            <!-- Description -->
                                            <p class="card-text"
                                                style="font-family: 'Red Hat Text', sans-serif; font-weight: 300;">
                                                {{ Str::limit($artikel->deskripsi_singkat, 120) }}
                                            </p>

                                            <!-- Read More Button -->
                                            <div class="mt-auto">
                                                @if ($artikel->link_artikel)
                                                    <a href="{{ $artikel->link_artikel }}" target="_blank"
                                                        class="btn btn-sm btn-outline-success">
                                                        Baca Selengkapnya <i class="fas fa-external-link-alt ms-1"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('dashboard.artikel.show', $artikel->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- No Articles Message -->
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                                <h4 style="font-family: 'Red Hat Text', sans-serif; color: #6c757d;">
                                    Belum Ada Artikel
                                </h4>
                                <p style="font-family: 'Red Hat Text', sans-serif; color: #6c757d;">
                                    Artikel edukasi akan segera hadir untuk Anda.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Load More Button (Optional) -->
                @if (isset($artikels) && $artikels->count() >= 6)
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <button class="btn btn-success" id="load-more-btn" data-page="2">
                                Muat Lebih Banyak
                                <div class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Call to Action -->
        <section class="">
            <div class="">
                <div class="row align-items-center">
                    <!-- Kolom untuk Gambar -->
                    <div class="col-12 col-sm-6 col-md-4 text-center text-sm-start mb-4 mb-sm-0">
                        <img src="{{ asset('assets/images/kurakura.png') }}" alt="Turtle" class="img-fluid"
                            style="max-width: 360px;">
                    </div>

                    <!-- Kolom untuk Teks CTA -->
                    <div class="col-12 col-sm-6 col-md-8 px-4">
                        <h2 class="fw-bold text-success mb-3 display-4">
                            Langkah Kecilmu, <span style="color: #24CE78;">Dampak Besar</span> Untuk <span
                                style="color: #24CE78;">Bumi Bersih</span>
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="bg-dark text-white py-5 footer-custom" style="background-color: #2E3A40;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <img src="{{ asset('assets/images/logoputih.png') }}" alt="TuNetic Logo" height="60"
                            class="mb-3">
                        <ul class="list-unstyled d-flex">
                            <li class="me-3"><a href="#" class="text-white"><i
                                        class="fab fa-facebook-f fa-2x"></i></a>
                            </li>
                            <li class="me-3"><a href="#" class="text-white"><i
                                        class="fab fa-instagram fa-2x"></i></a>
                            </li>
                            <li class="me-3"><a href="#" class="text-white"><i
                                        class="fab fa-twitter fa-2x"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h5 class="mb-3 fw-bold">TuNetic</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3"><a href="#"
                                    class="text-white text-decoration-none fw-light">Tentang
                                    Kami</a></li>
                            <li class="mb-3"><a href="#"
                                    class="text-white text-decoration-none fw-light">Layanan</a>
                            </li>
                            <li class="mb-3"><a href="#"
                                    class="text-white text-decoration-none fw-light">TPS</a></li>
                            <li class="mb-3"><a href="#"
                                    class="text-white text-decoration-none fw-light">Jadwal</a>
                            </li>
                            <li class="mb-3"><a href="#"
                                    class="text-white text-decoration-none fw-light">Edukasi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h5 class="mb-3 fw-semibold">Layanan</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3"><a href="#"
                                    class="text-white text-decoration-none fw-light">Jemput
                                    Sampah</a></li>
                            <li class="mb-3"><a href="#"
                                    class="text-white text-decoration-none fw-light">Lapor
                                    Sampah</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3 fw-bold">Contact</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-map-marker-alt me-2"></i> <span
                                    class="fw-light">Semarang,
                                    Indonesia</span>
                            </li>
                            <li class="mb-3"><i class="fas fa-envelope me-2 fw-light"></i> <span
                                    class="fw-light">TuNetic@gmail.com</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- ChatBot Toggle Button -->
        <button class="chatbot-toggle" data-bs-toggle="modal" data-bs-target="#chatModal">
            <i class="fas fa-comments"></i>
        </button>

        <!-- ChatBot Modal -->
        <div class="modal fade chat-modal" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel"
            aria-hidden="true" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Chat Header -->
                    <div class="chat-header">
                        <h5 class="mb-0" style="font-family: 'Red Hat Text', sans-serif; font-weight: 600;">
                            <i class="fas fa-robot me-2"></i>
                            TuNetic Assistant
                        </h5>
                        <small style="opacity: 0.9;">Tanya apa saja kepada saya!</small>
                        <button type="button" class="btn-close btn-close-white position-absolute"
                            style="top: 15px; right: 15px;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Chat Body -->
                    <div class="chat-body" id="chatBody">
                        <div class="message bot">
                            <div class="message-content">
                                <strong>TuNetic Assistant</strong><br>
                                Halo! Saya adalah asisten AI TuNetic. Saya bisa menjawab pertanyaan umum Anda. Silakan
                                tanyakan apa saja!
                            </div>
                        </div>
                    </div>

                    <!-- Chat Input -->
                    <div class="chat-input-area">
                        <form id="chatForm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="messageInput"
                                    placeholder="Ketik pesan Anda..." maxlength="1000" required>
                                <button class="btn btn-success" type="submit" id="sendButton">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>

        <!-- ChatBot JavaScript -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const chatForm = document.getElementById('chatForm');
                const messageInput = document.getElementById('messageInput');
                const chatBody = document.getElementById('chatBody');
                const sendButton = document.getElementById('sendButton');
                const chatModal = document.getElementById('chatModal');

                // CSRF Token untuk request
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

                if (!csrfToken) {
                    console.error('CSRF token not found');
                }

                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const message = messageInput.value.trim();
                    if (!message) return;

                    // Tampilkan pesan user
                    addMessage(message, 'user');

                    // Clear input dan disable button
                    messageInput.value = '';
                    sendButton.disabled = true;

                    // Tampilkan typing indicator
                    showTypingIndicator();

                    // Kirim request ke server
                    fetch('/chatbot/chat', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                message: message
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            hideTypingIndicator();

                            if (data.success) {
                                addMessage(data.message, 'bot');
                            } else {
                                addMessage(data.message || 'Maaf, terjadi kesalahan. Silakan coba lagi.',
                                    'bot');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            hideTypingIndicator();
                            addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot');
                        })
                        .finally(() => {
                            sendButton.disabled = false;
                            messageInput.focus();
                        });
                });

                function addMessage(message, sender) {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `message ${sender}`;

                    const contentDiv = document.createElement('div');
                    contentDiv.className = 'message-content';

                    if (sender === 'bot') {
                        contentDiv.innerHTML = `<strong>TuNetic Assistant</strong><br>${escapeHtml(message)}`;
                    } else {
                        contentDiv.textContent = message;
                    }

                    messageDiv.appendChild(contentDiv);
                    chatBody.appendChild(messageDiv);

                    // Scroll ke bawah
                    chatBody.scrollTop = chatBody.scrollHeight;
                }

                function showTypingIndicator() {
                    const typingDiv = document.createElement('div');
                    typingDiv.className = 'message bot';
                    typingDiv.id = 'typingIndicator';

                    const indicatorDiv = document.createElement('div');
                    indicatorDiv.className = 'typing-indicator';
                    indicatorDiv.innerHTML = `
                        <strong>TuNetic Assistant</strong> sedang mengetik
                        <div class="typing-dots ms-2">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    `;

                    typingDiv.appendChild(indicatorDiv);
                    chatBody.appendChild(typingDiv);
                    chatBody.scrollTop = chatBody.scrollHeight;
                }

                function hideTypingIndicator() {
                    const typingIndicator = document.getElementById('typingIndicator');
                    if (typingIndicator) {
                        typingIndicator.remove();
                    }
                }

                function escapeHtml(text) {
                    const map = {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    };
                    return text.replace(/[&<>"']/g, function(m) {
                        return map[m];
                    });
                }

                // Focus pada input ketika modal dibuka
                if (chatModal) {
                    chatModal.addEventListener('shown.bs.modal', function() {
                        if (messageInput) {
                            messageInput.focus();
                        }
                    });
                }

                // Handle Enter key
                if (messageInput) {
                    messageInput.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            if (chatForm) {
                                chatForm.dispatchEvent(new Event('submit'));
                            }
                        }
                    });
                }
            });
        </script>
</body>

</html>
