@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header">Tambah Tindakan ke Rekam Medis #{{ $rekam->idrekam_medis }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('dokter.detail-rekam-medis.store') }}">
                    @csrf
                    <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}" />
                    <div class="mb-3">
                        <label class="form-label">Kode Tindakan</label>
                        <select name="idkode_tindakan_terapi" class="form-select" required>
                            <option value="">- pilih -</option>
                            @foreach($kodetindakan as $k)
                                <option value="{{ $k->idkode_tindakan_terapi }}">{{ $k->kode }} - {{ Str::limit($k->deskripsi_tindakan_terapi,60) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan / Detail</label>
                        <textarea name="detail" class="form-control" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan Tindakan</button>
                    <a href="{{ route('dokter.rekam-medis.show', $rekam->idrekam_medis) }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
