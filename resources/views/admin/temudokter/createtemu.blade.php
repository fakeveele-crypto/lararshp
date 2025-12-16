@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Janji Temu Dokter</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.temu-dokter.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pet</label>
                        @if(!empty($pets) && count($pets))
                            <select name="idpet" class="form-control" required>
                                <option value="">-</option>
                                @foreach($pets as $p)
                                    <option value="{{ $p->idpet }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="idpet" class="form-control">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dokter</label>
                        @if(!empty($dokters) && count($dokters))
                            <select name="iddokter" class="form-control" required>
                                <option value="">-</option>
                                @foreach($dokters as $d)
                                    <option value="{{ $d->id_dokter ?? $d->id_dokter }}">{{ $d->user->nama ?? 'Dokter #' . ($d->id_dokter ?? $d->iddokter) }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="iddokter" class="form-control">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Waktu</label>
                        <input type="time" name="waktu" class="form-control">
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
