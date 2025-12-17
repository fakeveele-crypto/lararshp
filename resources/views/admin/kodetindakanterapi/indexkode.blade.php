@extends('layouts.lte.main')

@push('styles')
    <style>
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
        .container-view { width: 90%; margin: 50px auto; }
        .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
        .table th { background-color: #f1f1f1; font-weight: 600; }
        .btn-aksi { padding: 5px 10px; font-size: 0.85rem; }
    </style>
@endpush

@section('content')
    <div class="container-view">
        <h2 class="text-center">Data Kode Tindakan & Terapi</h2>
        <a href="{{ route('admin.kode-tindakan-terapi.create') }}" class="btn btn-primary mb-3 btn-aksi shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kode Tindakan
        </a>

        <div class="card">
            <div class="card-header">Tabel Rekam Medis (Tambah Tindakan)</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>ID RM</th>
                                <th>Tgl. Periksa</th>
                                <th>Nama Hewan</th>
                                <th>Pemilik</th>
                                <th>Dokter</th>
                                <th>Diagnosa Singkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekamMedis as $index => $rm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rm->idrekam_medis }}</td>
                                <td>
                                    @if(optional($rm->reservasi)->tanggal)
                                        {{ \Carbon\Carbon::parse($rm->reservasi->tanggal)->format('d/m/Y') }}
                                    @elseif($rm->created_at)
                                        {{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ optional($rm->pet)->nama ?? 'N/A' }}</td>
                                <td>{{ optional(optional(optional($rm->pet)->pemilik)->user)->nama ?? 'N/A' }}</td>
                                <td>
                                    @if(optional(optional($rm->dokter)->user)->nama)
                                        {{ optional(optional($rm->dokter)->user)->nama }}
                                    @elseif(optional(optional(optional($rm->reservasi)->dokter)->user)->nama)
                                        {{ optional(optional(optional($rm->reservasi)->dokter)->user)->nama }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($rm->diagnosa, 40) }}</td>
                                <td>
                                    <a href="{{ route('admin.detail-rekam-medis.create', ['idrekam' => $rm->idrekam_medis]) }}" class="btn btn-success btn-sm btn-aksi me-1">Tambah Tindakan</a>
                                    <a href="{{ route('admin.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-info btn-sm btn-aksi">Lihat RM</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada data Rekam Medis yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush