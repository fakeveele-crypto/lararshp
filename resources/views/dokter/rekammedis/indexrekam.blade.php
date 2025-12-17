@extends('layouts.lte.main')

@section('content')
<div class="container-view">
    <h2 class="text-center">Data Rekam Medis (Dokter)</h2>
    <p class="text-center text-muted">Riwayat pemeriksaan yang relevan untuk dokter.</p>

    <div class="card">
        <div class="card-header">Tabel Data Rekam Medis</div>
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
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis as $i => $rm)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $rm->idrekam_medis }}</td>
                            <td>
                                @if(optional($rm->reservasi)->tanggal)
                                    {{ \Carbon\Carbon::parse(optional($rm->reservasi)->tanggal)->format('d/m/Y') }}
                                @elseif($rm->created_at)
                                    {{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ optional($rm->pet)->nama ?? 'N/A' }}</td>
                            <td>{{ optional(optional(optional($rm->pet)->pemilik)->user)->nama ?? 'N/A' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($rm->diagnosa, 40) }}</td>
                            <td>
                                <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-info btn-sm">Lihat</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
