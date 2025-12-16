@extends('layouts.app')

@section('title', 'Layanan Umum RSHP UNAIR')

@section('content')
    <main class="container my-5 py-3">

        <div class="row text-center mb-5">
            <div class="col-12">
                <h1 class="display-4 text-primary">LAYANAN KOMPREHENSIF</h1>
                <h1 class="display-5 text-dark mb-3">RSHP UNIVERSITAS AIRLANGGA</h1>
                <hr class="custom-divider mx-auto">
                <p class="lead text-muted">Kami menyediakan berbagai layanan kesehatan hewan yang komprehensif didukung oleh dokter hewan profesional.</p>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="service-block text-center h-100">
                    <i class="bi bi-calendar-check service-icon text-info"></i>
                    <h4 class="fw-bold mb-2">Poli Umum & Rawat Jalan</h4>
                    <p class="text-muted small">Pemeriksaan kesehatan rutin, konsultasi, dan penanganan kasus penyakit ringan hingga sedang pada hewan kesayangan.</p>
                    <a href="#" class="btn-detail-clean">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-block text-center h-100">
                    <i class="bi bi-hospital service-icon text-danger"></i>
                    <h4 class="fw-bold mb-2">Rawat Inap & Intensive Care (ICU)</h4>
                    <p class="text-muted small">Perawatan intensif 24 jam dengan fasilitas monitoring lengkap untuk pasien kritis dan pasca operasi.</p>
                    <a href="#" class="btn-detail-clean">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-block text-center h-100">
                    <i class="bi bi-scissors service-icon text-secondary"></i>
                    <h4 class="fw-bold mb-2">Bedah dan Anestesi</h4>
                    <p class="text-muted small">Meliputi bedah umum, ortopedi, hingga bedah spesialis, didukung tim anestesi yang berpengalaman.</p>
                    <a href="#" class="btn-detail-clean">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-block text-center h-100">
                    <i class="bi bi-microscope service-icon text-success"></i>
                    <h4 class="fw-bold mb-2">Laboratorium & Diagnostik</h4>
                    <p class="text-muted small">Layanan pemeriksaan darah, urin, feses, dan radiologi (X-ray, USG) untuk diagnosis akurat.</p>
                    <a href="#" class="btn-detail-clean">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-block text-center h-100">
                    <i class="bi bi-shield-lock service-icon text-warning"></i>
                    <h4 class="fw-bold mb-2">Vaksinasi & Preventif</h4>
                    <p class="text-muted small">Program vaksinasi lengkap, obat cacing, dan penanganan kutu untuk menjaga kesehatan optimal.</p>
                    <a href="#" class="btn-detail-clean">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-block text-center h-100">
                    <i class="bi bi-phone service-icon text-primary"></i>
                    <h4 class="fw-bold mb-2">Panggilan Darurat (Ambulans)</h4>
                    <p class="text-muted small">Respons cepat 24 jam untuk kondisi gawat darurat yang membutuhkan penjemputan dan penanganan segera.</p>
                    <a href="#" class="btn-detail-clean">Hubungi Kami <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

        </div>
        <div class="text-center mt-5 pt-4">
            <h2 class="fw-bold mb-4">Informasi Biaya</h2>
            <a href="#" class="btn btn-lg btn-outline-dark">Lihat Daftar Tarif Layanan</a>
        </div>

    </main>
@endsection
