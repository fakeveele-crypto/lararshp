@extends('layouts.app')

@section('title', 'Struktur Organisasi RSHP UNAIR')

@section('content')
    <main class="container my-5 py-3">

        <div class="row text-center mb-5">
            <div class="col-12">
                <h1 class="display-4 text-primary">STRUKTUR ORGANISASI</h1>
                <h1 class="display-5 text-dark mb-3">RSHP UNIVERSITAS AIRLANGGA</h1>
                <hr class="custom-divider mx-auto">
                <p class="lead text-muted">Struktur kepemimpinan yang mendukung pelayanan, pendidikan, dan penelitian secara profesional.</p>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="text-secondary fw-bold">Pimpinan Inti</h2>
                <hr class="custom-divider mx-auto w-25">
            </div>

            <div class="col-lg-10 mb-3">
                <div class="card leader-card shadow-sm p-3">
                    <div class="card-body">
                        <i class="bi bi-person-workspace h3 text-primary float-end"></i>
                        <h5 class="fw-bold mb-1">Direktur</h5>
                        <p class="mb-0">Dr. Ira Sari Yudaniwaty, M.P., drh.</p>
                        <span class="badge bg-primary">Kepemimpinan Tertinggi</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 mb-3">
                <div class="card leader-card shadow-sm p-3">
                    <div class="card-body">
                        <i class="bi bi-award h3 text-success float-end"></i>
                        <h5 class="fw-bold mb-1">Wakil Direktur Pelayanan Medis, Pendidikan dan Penelitian</h5>
                        <p class="mb-0">Dr. Nushanto Traokso, M.P., drh.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 mb-3">
                <div class="card leader-card shadow-sm p-3">
                    <div class="card-body">
                        <i class="bi bi-building h3 text-info float-end"></i>
                        <h5 class="fw-bold mb-1">Wakil Direktur SDM, Sarana Prasarana dan Keuangan</h5>
                        <p class="mb-0">Dr. Miyayu Soneta S, M.Vet., drh.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <h2 class="text-secondary fw-bold text-center mb-4">Bagan Struktur Organisasi</h2>
                <div class="organization-chart-container text-center">
                    <p class="text-muted">Struktur ini membawahi unit-unit pelayanan seperti rawat jalan, rawat inap, bedah, radiologi, farmasi, serta aspek pendidikan dan penelitian di bawah naungan Universitas Airlangga.</p>
                    {{-- PLACEHOLDER: Ganti dengan jalur gambar diagram asli Anda --}}
                    <img src="{{ asset('assets/images/struktur_diagram_placeholder.png') }}" alt="Diagram Struktur Organisasi RSHP UNAIR" class="img-fluid my-4">
                </div>
            </div>
        </div>

    </main>
@endsection
