@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Detail Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h3></div>
            <div class="card-body">
                <div class="mb-3"><strong>Nama Hewan:</strong> {{ $rekamMedis->pet->nama ?? 'N/A' }}</div>
                <div class="mb-3"><strong>Anamnesa:</strong><p class="border rounded p-2">{{ $rekamMedis->anamnesa ?? '-' }}</p></div>
                <div class="mb-3"><strong>Temuan Klinis:</strong><p class="border rounded p-2">{{ $rekamMedis->temuan_klinis ?? '-' }}</p></div>
                <div class="mb-3"><strong>Diagnosa:</strong><p class="border rounded p-2">{{ $rekamMedis->diagnosa ?? '-' }}</p></div>

                <h5>Tindakan</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekamMedis->details as $i => $d)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $d->kodeTindakanTerapi->kode ?? '-' }}</td>
                                    <td>{{ $d->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? $d->kodeTindakanTerapi->nama_tindakan ?? '-' }}</td>
                                    <td>{{ $d->detail ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center">Belum ada tindakan tercatat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
