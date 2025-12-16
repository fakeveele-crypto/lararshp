@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Kategori Klinis</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.kategori-klinis.update', $item->idkategori_klinis) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori Klinis</label>
                        <input type="text" name="nama_kategori_klinis" class="form-control" value="{{ old('nama_kategori_klinis', $item->nama_kategori_klinis) }}" required>
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
