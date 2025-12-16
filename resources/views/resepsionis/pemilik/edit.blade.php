@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Pemilik</h3></div>
            <div class="card-body">
                <form action="{{ route('resepsionis.datapemilik.update', $item->idpemilik) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">No WA</label>
                        <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa', $item->no_wa) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control">{{ old('alamat', $item->alamat) }}</textarea>
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('resepsionis.datapemilik.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
