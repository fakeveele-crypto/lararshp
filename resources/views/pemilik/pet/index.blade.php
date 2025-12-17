@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header">Tabel Data Hewan Saya</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Ras</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pets as $i => $p)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ optional($p->ras)->nama ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('pemilik.pet.show', $p->idpet) }}" class="btn btn-info btn-sm">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
