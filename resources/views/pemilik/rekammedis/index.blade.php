@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header">Tabel Rekam Medis Saya</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Rekam</th>
                            <th>Hewan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedis as $i => $r)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>RM#{{ $r->idrekam_medis }}</td>
                                <td>{{ optional($r->pet)->nama ?? '-' }}</td>
                                <td>{{ $r->created_at ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('pemilik.rekam-medis.show', $r->idrekam_medis) }}" class="btn btn-info btn-sm">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
