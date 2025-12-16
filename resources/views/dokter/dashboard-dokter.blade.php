@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="row mb-3">
            <div class="col-lg-4 col-12">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $stats['rekam_medis'] ?? 0 }}</h3>
                        <p>Rekam Medis</p>
                    </div>
                    <div class="icon"><i class="bi bi-file-medical"></i></div>
                    <a href="{{ route('dokter.rekam-medis.index') }}" class="small-box-footer">Manage <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $stats['appointments_today'] ?? 0 }}</h3>
                        <p>Janji Hari Ini</p>
                    </div>
                    <div class="icon"><i class="bi bi-calendar-check"></i></div>
                    <a href="{{ route('dokter.rekam-medis.index') }}" class="small-box-footer">Lihat <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box text-bg-info">
                    <div class="inner">
                        <h3>{{ $stats['patients_today'] ?? 0 }}</h3>
                        <p>Pasien Hari Ini</p>
                    </div>
                    <div class="icon"><i class="bi bi-people"></i></div>
                    <a href="{{ route('dokter.rekam-medis.index') }}" class="small-box-footer">Detail <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-header">Recent Rekam Medis</div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Pet</th>
                                    <th>Pemilik</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(($data['rekamMediss'] ?? collect())->take(10) as $r)
                                    <tr>
                                        <td>{{ optional($r->pet)->nama ?? '-' }}</td>
                                        <td>{{ optional(optional($r->pet)->pemilik)->user->nama ?? '-' }}</td>
                                        <td>{{ optional(\Carbon\Carbon::parse($r->temuDokter->tanggal ?? $r->created_at))->format('d/m/Y') ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('dokter.rekam-medis.show', $r->id ?? $r->idrekam_medis ?? '') }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dashboard Dokter</h3>
                    </div>
                    <div class="card-body">
                        <p>Selamat datang di dashboard Dokter. Gunakan menu di samping untuk mengelola pasien dan rekam medis Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
