@extends('layouts.lte.main')

@push('styles')
    <style>
        /* Styling konsisten dengan site.css */
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
        .container-view { width: 70%; margin: 50px auto; }
        /* Styling Card dan Tabel */
        .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
        .table th { background-color: #f1f1f1; font-weight: 600; }
        .btn-aksi { padding: 5px 10px; font-size: 0.85rem; }
    </style>
@endpush

@section('content')
    <div class="container-view">
        <h2 class="text-center">Data Jenis Hewan</h2>
        <a href="{{route('admin.jenis-hewan.create')}}" class="btn btn-primary mb-3 btn-aksi shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Jenis
        </a>

        <div class="card">
            <div class="card-header">Tabel Data Jenis Hewan</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Jenis Hewan</th>
                                <th>Nama Jenis Hewan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenishewan as $index => $hewan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $hewan->idjenis_hewan }}</td>
                                <td>{{ $hewan->nama_jenis_hewan }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-aksi me-1">Edit</a>
                                    <button class="btn btn-danger btn-sm btn-aksi">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data Jenis Hewan yang ditemukan.</td>
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