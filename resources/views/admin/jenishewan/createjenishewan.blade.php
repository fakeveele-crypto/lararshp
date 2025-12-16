@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Jenis Hewan</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Jenis Hewan</label>
                        <input type="text" name="nama_jenis_hewan" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
