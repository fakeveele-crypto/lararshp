@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Rekam Medis</h3></div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
                @endif

                <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Pet (Reservasi Pending)</label>
                                <select name="idpet" class="form-select" required>
                                    <option value="">- Pilih Pet -</option>
                                    @foreach($pets as $p)
                                        <option value="{{ $p->idpet }}">{{ $p->nama }}@if(optional(optional($p->pemilik)->user)->nama) - {{ optional(optional($p->pemilik)->user)->nama }}@endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Anamnesa</label>
                                <textarea name="anamnesa" class="form-control" rows="3">{{ old('anamnesa') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Temuan Klinis</label>
                                <textarea name="temuan_klinis" class="form-control" rows="3">{{ old('temuan_klinis') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Diagnosa</label>
                                <textarea name="diagnosa" class="form-control" rows="2">{{ old('diagnosa') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 d-flex gap-2">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
