@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Perawat</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dataperawat.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama User</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email User</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password User</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pendidikan</label>
                        <input type="text" name="pendidikan" class="form-control" value="{{ old('pendidikan') }}" required>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.dataperawat.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
