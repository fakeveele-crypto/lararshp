@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header">Tabel Janji Temu Saya</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hewan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($temu as $i => $t)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ optional($t->pet)->nama ?? '-' }}</td>
                                <td>{{ $t->tanggal }}</td>
                                <td>{{ $t->waktu }}</td>
                                <td>{{ $t->status }}</td>
                                <td>
                                    <a href="{{ route('pemilik.temu-dokter.show', $t->idtemu_dokter) }}" class="btn btn-info btn-sm">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
