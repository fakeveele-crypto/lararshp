@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="row mb-3">
            <div class="col-lg-4 col-12">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['rekam_medis'] ?? 0 }}</h3>
                        <p>Rekam Medis</p>
                    </div>
                    <div class="icon"><i class="bi bi-file-medical"></i></div>
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            
        <div class="card mb-3">
            <div class="card-header">Recent Rekam Medis</div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Pet</th>
                            <th>Dokter</th>
                            <th>Waktu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(($data['rekamMediss'] ?? collect())->take(10) as $r)
                            <tr>
                                <td>{{ $r->temuDokter->pet->nama ?? '-' }}</td>
                                <td>{{ $r->roleUser->user->nama ?? '-' }}</td>
                                <td>{{ optional(\Carbon\Carbon::parse($r->temuDokter->waktu ?? $r->created_at))->format('Y-m-d H:i') ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('perawat.rekam-medis.show', $r->id) }}" class="btn btn-sm btn-primary">View</a>
                                    @if(session('user_role') == 3)
                                        <a href="{{ route('perawat.rekam-medis.edit', $r->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dashboard Perawat</h3>
            </div>
            <div class="card-body">
                <p>Selamat datang di dashboard Perawat. Gunakan menu di samping untuk mengakses Rekam Medis dan tugas lainnya.</p>
            </div>
        </div>
    </div>

@endsection
