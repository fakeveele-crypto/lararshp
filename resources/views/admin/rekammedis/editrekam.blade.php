@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Rekam Medis</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.rekam-medis.update', $item->idrekam_medis) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Pet ID</label>
                        <input type="number" name="idpet" class="form-control" value="{{ old('idpet', $item->idpet) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anamnesa</label>
                        <textarea name="anamnesa" class="form-control">{{ old('anamnesa', $item->anamnesa) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Temuan Klinis</label>
                        <textarea name="temuan_klinis" class="form-control">{{ old('temuan_klinis', $item->temuan_klinis) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" class="form-control">{{ old('diagnosa', $item->diagnosa) }}</textarea>
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
