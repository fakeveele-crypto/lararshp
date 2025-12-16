@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Tindakan ke Rekam Medis</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.detail-rekam-medis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Rekam Medis</label>
                        @if(isset($idrekam) && $idrekam)
                            @php
                                $selectedRm = null;
                                foreach($rekamMedis as $r){ if($r->idrekam_medis == $idrekam){ $selectedRm = $r; break; } }
                            @endphp
                            @if($selectedRm)
                                <div class="form-control-plaintext mb-2">#{{ $selectedRm->idrekam_medis }} - {{ $selectedRm->pet->nama ?? 'Pet #' . $selectedRm->idpet }} - {{ optional($selectedRm->created_at)->format('d/m/Y') ?? '' }}</div>
                                <input type="hidden" name="idrekam_medis" value="{{ $selectedRm->idrekam_medis }}">
                            @else
                                <div class="alert alert-warning">Rekam medis yang dipilih tidak ditemukan. Pilih manual di bawah.</div>
                                <select name="idrekam_medis" class="form-control" required>
                                    <option value="">- pilih rekam medis -</option>
                                    @foreach($rekamMedis as $rm)
                                        <option value="{{ $rm->idrekam_medis }}">#{{ $rm->idrekam_medis }} - {{ $rm->pet->nama ?? 'Pet #' . $rm->idpet }} - {{ optional($rm->created_at)->format('d/m/Y') ?? '' }}</option>
                                    @endforeach
                                </select>
                            @endif
                        @else
                            <select name="idrekam_medis" class="form-control" required>
                                <option value="">- pilih rekam medis -</option>
                                @foreach($rekamMedis as $rm)
                                    <option value="{{ $rm->idrekam_medis }}">#{{ $rm->idrekam_medis }} - {{ $rm->pet->nama ?? 'Pet #' . $rm->idpet }} - {{ optional($rm->created_at)->format('d/m/Y') ?? '' }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Kode Tindakan (berdasarkan Kategori Klinis)</label>
                        <select name="idkode_tindakan_terapi" class="form-control" required>
                            <option value="">- pilih kode tindakan -</option>
                            @foreach($kodes as $kategori => $items)
                                <optgroup label="{{ $kategori }}">
                                    @foreach($items as $kd)
                                        <option value="{{ $kd->idkode_tindakan_terapi }}" {{ isset($idkode) && $idkode == $kd->idkode_tindakan_terapi ? 'selected' : '' }}>
                                            {{ $kd->kode }} - {{ $kd->deskripsi_tindakan_terapi ?? $kd->nama_tindakan ?? '' }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Detail / Catatan</label>
                        <textarea name="detail" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">Simpan Tindakan</button>
                    <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
