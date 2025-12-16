@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Detail Rekam Medis #{{ $item->idrekam_medis }}</h3></div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Nama Hewan:</strong> {{ $item->pet->nama ?? 'N/A' }}
                </div>
                <div class="mb-3">
                    <strong>Anamnesa:</strong>
                    <p class="border rounded p-2">{{ $item->anamnesa ?? '-' }}</p>
                </div>
                <div class="mb-3">
                    <strong>Temuan Klinis:</strong>
                    <p class="border rounded p-2">{{ $item->temuan_klinis ?? '-' }}</p>
                </div>
                <div class="mb-3">
                    <strong>Diagnosa:</strong>
                    <p class="border rounded p-2">{{ $item->diagnosa ?? '-' }}</p>
                </div>

                <h5>Tindakan</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($item->details as $i => $d)
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

                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('admin.detail-rekam-medis.create', ['idrekam' => $item->idrekam_medis]) }}" class="btn btn-success">Tambah Tindakan</a>
            </div>
        </div>
    </div>
@endsection
