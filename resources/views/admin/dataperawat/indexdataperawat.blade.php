@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Data Perawat</h3>
                <a href="{{ route('admin.dataperawat.create') }}" class="btn btn-sm btn-success">Tambah Perawat</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Departemen</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Placeholder: loop perawat items when provided by controller --}}
                        @forelse($perawats ?? [] as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->user->nama ?? '-' }}</td>
                                <td>{{ $p->pendidikan ?? '-' }}</td>
                                <td>{{ $p->user->email ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.dataperawat.edit', ['perawat' => $p->idperawat]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.dataperawat.destroy', ['perawat' => $p->idperawat]) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus data perawat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data perawat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
