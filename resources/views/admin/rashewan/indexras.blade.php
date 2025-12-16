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
        <h2 class="text-center">Data Ras Hewan</h2>
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary mb-3 btn-aksi shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Ras Hewan
        </a>

        <div class="card">
            <div class="card-header">Tabel Data Ras Hewan</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>ID Ras Hewan</th>
                                <th>Nama Ras Hewan</th>
                                <th>Jenis Hewan</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rasHewan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->idras_hewan }}</td>
                                <td>{{ $item->nama_ras }}</td>
                                <td>{{ $item->jenisHewan->nama_jenis_hewan ?? 'Jenis Tidak Ditemukan' }}</td>
                                <td>
                                    <a href="{{ route('admin.ras-hewan.edit', $item->idras_hewan) }}" class="btn btn-warning btn-sm btn-aksi me-1" title="Edit Data Ras">Edit</a>
                                    <form action="{{ route('admin.ras-hewan.destroy', $item->idras_hewan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ras ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-aksi" title="Hapus Ras">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data Ras Hewan yang ditemukan.</td>
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