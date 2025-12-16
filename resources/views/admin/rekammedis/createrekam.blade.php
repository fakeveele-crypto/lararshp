@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Rekam Medis</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Janji Temu (temu_dokter)</label>
                        @if(!empty($temuDokters) && count($temuDokters))
                            <select name="idtemu_dokter" class="form-control" required>
                                <option value="">- pilih janji temu -</option>
                                @foreach($temuDokters as $td)
                                    <option value="{{ $td->idtemu_dokter }}">
                                        {{ $loop->iteration }}. {{ $td->tanggal }} {{ $td->waktu }} - {{ $td->pet->nama ?? 'Pet #' . ($td->idpet ?? '') }} - {{ $td->dokter->user->nama ?? 'Dokter #' . ($td->dokter->id_dokter ?? $td->dokter->iddokter ?? '') }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="idtemu_dokter" class="form-control">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anamnesa</label>
                        <textarea name="anamnesa" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Temuan Klinis</label>
                        <textarea name="temuan_klinis" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
