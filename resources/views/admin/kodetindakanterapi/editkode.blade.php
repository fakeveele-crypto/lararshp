@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Kode Tindakan/Terapi</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.kode-tindakan-terapi.update', $item->idkode_tindakan_terapi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" name="kode" class="form-control" value="{{ old('kode', $item->kode) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Tindakan</label>
                        <input type="text" name="nama_tindakan" class="form-control" value="{{ old('nama_tindakan', $item->nama_tindakan) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biaya</label>
                        <input type="number" step="0.01" name="biaya" class="form-control" value="{{ old('biaya', $item->biaya) }}">
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
