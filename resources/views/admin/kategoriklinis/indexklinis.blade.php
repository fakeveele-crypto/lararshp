@extends('layouts.lte.main')

@push('styles')
    <style>
        /* Styling konsisten dengan site.css */
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
        .container-view { width: 80%; margin: 50px auto; }
        .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
        .table th { background-color: #f1f1f1; font-weight: 600; }
        .btn-aksi { padding: 5px 10px; font-size: 0.85rem; }
    </style>
@endpush

@section('content')
    <div class="container-view">
        <h2 class="text-center">Data Kategori Klinis</h2>
        <a href="{{route('admin.kategori-klinis.create')}}" class="btn btn-primary mb-3 btn-aksi shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kategori Klinis
        </a>

        <div class="card">
            <div class="card-header">Tabel Data Kategori Klinis</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>ID Klinis</th>
                                <th>Nama Kategori Klinis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategoriKlinis as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->idkategori_klinis }}</td>
                                <td>{{ $item->nama_kategori_klinis }}</td>
                                <td>
                                    <a href="{{ route('admin.kategori-klinis.edit', $item->idkategori_klinis) }}" class="btn btn-warning btn-sm btn-aksi me-1" title="Edit Data Klinis">Edit</a>
                                    <form action="{{ route('admin.kategori-klinis.destroy', $item->idkategori_klinis) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-aksi" title="Hapus Kategori Klinis" onclick="return confirm('Yakin ingin menghapus data kategori klinis ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data Kategori Klinis yang ditemukan.</td>
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