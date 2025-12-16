@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Dokter</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.datadokter.update', $dokter->iddokter) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">User ID</label>
                        <input type="number" name="id_user" class="form-control" value="{{ old('id_user', $dokter->id_user ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bidang Dokter</label>
                        <input type="text" name="bidang_dokter" class="form-control" value="{{ old('bidang_dokter', $dokter->bidang_dokter ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $dokter->no_hp ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control">{{ old('alamat', $dokter->alamat ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="L" {{ (old('jenis_kelamin', $dokter->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ (old('jenis_kelamin', $dokter->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.datadokter.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
