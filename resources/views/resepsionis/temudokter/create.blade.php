@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Janji Temu Dokter</h3></div>
            <div class="card-body">
                <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Pilih Hewan</label>
                        <select name="idpet" class="form-control" required>
                            <option value="">- Pilih Hewan -</option>
                            @foreach($pets as $p)
                                <option value="{{ $p->idpet }}">{{ $p->nama ?? ('Pet #' . $p->idpet) }} — {{ optional(optional($p->pemilik)->user)->nama ?? 'Pemilik #' . optional($p->pemilik)->idpemilik }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dokter Tujuan</label>
                        <select name="id_dokter" class="form-control" required>
                            <option value="">- Pilih Dokter -</option>
                            @foreach($dokters as $d)
                                <option value="{{ $d->id_dokter }}">{{ optional($d->user)->nama ?? ('Dokter #' . $d->id_dokter) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Waktu</label>
                        <input type="time" name="waktu" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keluhan</label>
                        <textarea name="keluhan" class="form-control" rows="3"></textarea>
                    </div>

                    <button class="btn btn-success">Jadwalkan</button>
                    <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
