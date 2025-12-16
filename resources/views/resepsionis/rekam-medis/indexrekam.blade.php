@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">Data Rekam Medis</div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID RM</th>
                            <th>Tanggal</th>
                            <th>Nama Hewan</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis as $i => $r)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $r->idrekam_medis }}</td>
                            <td>{{ optional(optional($r->reservasi)->tanggal) ? \Carbon\Carbon::parse($r->reservasi->tanggal)->format('d/m/Y') : optional($r->created_at) ? \Carbon\Carbon::parse($r->created_at)->format('d/m/Y') : '-' }}</td>
                            <td>{{ optional($r->pet)->nama ?? '-' }}</td>
                            <td>{{ optional(optional($r->pet)->pemilik)->user->nama ?? '-' }}</td>
                            <td>{{ optional(optional($r->dokter)->user)->nama ?? '-' }}</td>
                            <td><a href="{{ route('resepsionis.rekam-medis.show', $r->idrekam_medis) }}" class="btn btn-sm btn-info">Lihat</a></td>
                        </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
