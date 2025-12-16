@extends('layouts.app')

@section('title', 'Rumah Sakit Hewan Pendidikan - UNAIR')

@section('content')
    <section class="hero-section">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">SELAMAT DATANG DI RSHP UNAIR</h1>
            <p class="lead">Pelayanan terdepan, didukung tenaga medis berpengalaman.</p>
            <a href="#" class="btn btn-warning btn-lg fw-bold mt-3 shadow">DAFTAR ONLINE SEKARANG</a>
        </div>
    </section>

    <main class="container my-5 py-3">

        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="text-primary fw-bold">Tentang Kami</h2>
                <hr class="custom-divider mx-auto">
            </div>

            <div class="col-lg-8">
                <p class="lead">Rumah Sakit Hewan Pendidikan Universitas Airlangga terus berupaya memberikan pelayanan terbaik bagi para pemilik hewan.</p>
                <p>Salah satu bentuk inovasi yang dihadirkan adalah layanan pendaftaran online, yang dirancang untuk memudahkan proses administrasi tanpa harus mengantri secara langsung di lokasi. Dengan adanya sistem ini, pemilik hewan dapat mendaftarkan hewan kesayangannya kapan saja dan di mana saja hanya melalui perangkat smartphone atau komputer.</p>
                <p>Selain menghemat waktu, pendaftaran online juga membantu proses pemeriksaan menjadi lebih cepat dan teratur, sehingga hewan peliharaan bisa segera mendapatkan penanganan dari tenaga medis yang berpengalaman.</p>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card shadow-sm border-0">
                    <img src="{{ asset('assets/images/penampakan.jpeg') }}" class="card-img-top" alt="Rumah Sakit Hewan Pendidikan">
                    <div class="card-body quote-card">
                        <blockquote class="blockquote mb-0">
                            <p class="fst-italic text-dark">"Peduli, Profesional, dan Ramah untuk Hewan Kesayangan Anda"</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-4 text-center">
            <div class="col-12 mb-5">
                <h2 class="text-secondary fw-bold">Pelayanan Terbaik & Inovatif</h2>
                <hr class="custom-divider mx-auto">
                <p class="text-muted fs-5">Layanan unggulan kami siap melayani Anda dan hewan kesayangan.</p>
            </div>

            <div class="col-md-4 mb-4">
                <div class="service-block text-center h-100">
                    <i class="bi bi-hospital service-icon text-danger"></i>
                    <h4 class="fw-bold mb-2">Rawat Inap 24 Jam</h4>
                    <p class="text-muted small">Perawatan intensif dan monitoring kondisi hewan Anda sepanjang hari.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="service-block text-center h-100">
                    <i class="bi bi-laptop service-icon text-success"></i>
                    <h4 class="fw-bold mb-2">Pendaftaran Online</h4>
                    <p class="text-muted small">Administrasi cepat tanpa antrian, reservasi pemeriksaan melalui website.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="service-block text-center h-100">
                    <i class="bi bi-scissors service-icon text-secondary"></i>
                    <h4 class="fw-bold mb-2">Bedah & Diagnostik</h4>
                    <p class="text-muted small">Didukung peralatan canggih dan dokter bedah spesialis untuk tindakan medis.</p>
                </div>
            </div>

        </div>

        <div class="text-center mt-4">
             <a href="{{ route('layanan') }}" class="btn btn-outline-primary btn-lg">Lihat Semua Layanan</a>
        </div>

    </main>
@endsection
