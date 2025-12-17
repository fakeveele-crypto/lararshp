@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header">Edit Tindakan #{{ $detail->iddetail_rekam_medis }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('dokter.detail-rekam-medis.update', $detail->iddetail_rekam_medis) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="idrekam_medis" value="{{ $detail->idrekam_medis }}" />
                    <div class="mb-3">
                        <label class="form-label">Kode Tindakan</label>
                        <select name="idkode_tindakan_terapi" class="form-select" required>
                            <option value="">- pilih -</option>
                            @foreach($kodetindakan as $k)
                                <option value="{{ $k->idkode_tindakan_terapi }}" {{ $detail->idkode_tindakan_terapi == $k->idkode_tindakan_terapi ? 'selected' : '' }}>{{ $k->kode }} - {{ Str::limit($k->deskripsi_tindakan_terapi,60) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan / Detail</label>
                        <textarea name="detail" class="form-control" rows="3">{{ $detail->detail }}</textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    <a href="{{ route('dokter.rekam-medis.show', $detail->idrekam_medis) }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
