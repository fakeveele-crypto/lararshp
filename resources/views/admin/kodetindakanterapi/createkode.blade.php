@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Kode Tindakan/Terapi</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Tindakan</label>
                        <input type="text" name="nama_tindakan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biaya</label>
                        <input type="number" step="0.01" name="biaya" class="form-control">
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
