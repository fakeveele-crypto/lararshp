@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Kategori Klinis</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori Klinis</label>
                        <input type="text" name="nama_kategori_klinis" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
