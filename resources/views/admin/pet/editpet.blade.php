@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Pet</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $pet->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna / Tanda</label>
                        <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda', $pet->warna_tanda) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-</option>
                            <option value="L" {{ (old('jenis_kelamin', $pet->jenis_kelamin) == 'L') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ (old('jenis_kelamin', $pet->jenis_kelamin) == 'P') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ras ID</label>
                        <input type="number" name="idras_hewan" class="form-control" value="{{ old('idras_hewan', $pet->idras_hewan) }}">
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
