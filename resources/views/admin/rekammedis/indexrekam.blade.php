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
        <h2 class="text-center">Data Rekam Medis Global</h2>
        <p class="text-center text-muted">Seluruh riwayat pemeriksaan hewan tercatat di sini.</p>

        <div class="card">
            <div class="card-header">Tabel Data Rekam Medis</div>
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-primary">Tambah Rekam Medis</a>
                </div>
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
                                <td>{{ \Carbon\Carbon::parse($rm->tanggal_periksa)->format('d/m/Y') }}</td>
                                <td>{{ $rm->pet->nama_pet ?? 'N/A' }}</td>
                                <td>{{ $rm->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                <td>{{ $rm->dokter->user->nama ?? 'N/A' }}</td>
                                <td>{{ Str::limit($rm->diagnosa, 40) }}</td>
                                <td>
                                    <a href="#" class="btn btn-info text-white btn-sm btn-aksi me-1" title="Lihat Detail">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-aksi" title="Hapus RM" onclick="return confirm('Yakin ingin menghapus Rekam Medis ini?')">Hapus</button>
                                    </form>
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