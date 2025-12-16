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
        <h2 class="text-center">Data Pemilik Hewan</h2>
        <a href="{{ route('resepsionis.datapemilik.create') }}" class="btn btn-primary mb-3 btn-aksi shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah Pemilik
        </a>

        <div class="card">
            <div class="card-header">Tabel Data Pemilik</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pemilik</th>
                                <th>Nama Pemilik (dari User)</th>
                                <th>Email (dari User)</th>
                                <th>No WA</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pemilik as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->idpemilik }}</td>
                                <td>{{ $item->user->nama ?? 'N/A' }}</td>
                                <td>{{ $item->user->email ?? 'N/A' }}</td>
                                <td>{{ $item->no_wa }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href="{{ route('resepsionis.datapemilik.edit', $item->idpemilik) }}" class="btn btn-warning btn-sm btn-aksi me-1">Edit</a>
                                    <form action="{{ route('resepsionis.datapemilik.destroy', $item->idpemilik) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pemilik ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-aksi">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada data Pemilik yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
