@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Dokter</h3>
                    <a href="{{ route('admin.datadokter.create') }}" class="btn btn-sm btn-success">Tambah Dokter</a>
                </div>
                <div class="card-body table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Spesialis</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Placeholder: loop dokter items when provided by controller --}}
                        @forelse($dokters ?? [] as $i => $d)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $d->user->nama ?? '-' }}</td>
                                <td>{{ $d->bidang_dokter ?? '-' }}</td>
                                <td>{{ $d->user->email ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.datadokter.edit', $d->iddokter) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.datadokter.destroy', $d->iddokter) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus data dokter ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data dokter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
