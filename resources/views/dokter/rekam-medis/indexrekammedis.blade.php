@extends('layouts.lte.main')

@push('styles')
    <style>
        .container-view { width: 95%; margin: 30px auto; }
        .card { border: none; }
    </style>
@endpush

@section('content')
    <div class="container-view">
        <h2 class="text-center">Rekam Medis (Dokter)</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID RM</th>
                                <th>Tgl. Periksa</th>
                                <th>Nama Hewan</th>
                                <th>Pemilik</th>
                                <th>Diagnosa Singkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekamMedis as $index => $rm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rm->idrekam_medis }}</td>
                                <td>{{ optional(optional($rm->reservasi)->tanggal) ? \Carbon\Carbon::parse($rm->reservasi->tanggal)->format('d/m/Y') : (optional($rm->created_at) ? \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y') : '-') }}</td>
                                <td>{{ optional($rm->pet)->nama ?? 'N/A' }}</td>
                                <td>{{ optional(optional($rm->pet)->pemilik)->user->nama ?? 'N/A' }}</td>
                                <td>{{ Str::limit($rm->diagnosa, 40) }}</td>
                                <td>
                                    <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-info btn-sm">Lihat</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
