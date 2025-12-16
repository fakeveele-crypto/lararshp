@extends('layouts.lte.main')

@push('styles')
    <style>
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
        .container-view { width: 95%; margin: 50px auto; }
        .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
        .table th { background-color: #f1f1f1; font-weight: 600; }
        .btn-aksi { padding: 5px 10px; font-size: 0.85rem; }
    </style>
@endpush

@section('content')
    <div class="container-view">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="text-start">Data Janji Temu Dokter</h2>
                <p class="text-muted mb-0">Daftar seluruh janji temu yang dijadwalkan.</p>
            </div>
            <div>
                <a href="{{ route('admin.temu-dokter.create') }}" class="btn btn-success btn-aksi shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Janji Temu
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Tabel Data Janji Temu</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>ID Temu</th>
                                <th>Tanggal & Waktu</th>
                                <th>Nama Hewan</th>
                                <th>Pemilik</th>
                                <th>Dokter Tujuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($temuDokter as $index => $temu)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $temu->idtemu_dokter }}</td>
                                <td>{{ \Carbon\Carbon::parse($temu->tanggal)->format('d/m/Y') }} Pukul {{ $temu->waktu }}</td>
                                <td>{{ $temu->pet->nama ?? 'N/A' }}</td>
                                <td>{{ $temu->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                <td>{{ $temu->dokter->user->nama ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $statusClass = match($temu->status) {
                                            'Pending' => 'bg-warning',
                                            'Selesai' => 'bg-success',
                                            'Dibatalkan' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}" style="color:white; font-size: 0.8rem;">{{ $temu->status }}</span>
                                </td>
                                <td>
                                    <a href="{{route('admin.temu-dokter.edit',$temu->idtemu_dokter)}}" class="btn btn-warning btn-sm btn-aksi me-1" title="Ubah Status"><i class="bi bi-pencil-square"></i> Status</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada data Janji Temu yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- scripts are provided by layouts/lte/scripts.blade.php --}}