@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Perawat</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dataperawat.update', ['perawat' => $perawat->idperawat]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">User ID</label>
                        <input type="number" name="id_user" class="form-control" value="{{ old('id_user', $perawat->id_user ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $perawat->user->nama ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pendidikan</label>
                        <input type="text" name="pendidikan" class="form-control" value="{{ old('pendidikan', $perawat->pendidikan ?? '') }}">
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.dataperawat.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
