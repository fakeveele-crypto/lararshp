@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Detail Rekam Medis #{{ $item->idrekam_medis }}</h3></div>
            <div class="card-body">
                <p><strong>Hewan:</strong> {{ optional($item->pet)->nama }}</p>
                <p><strong>Anamnesa:</strong> {{ $item->anamnesa ?? '-' }}</p>
                <p><strong>Temuan Klinis:</strong> {{ $item->temuan_klinis ?? '-' }}</p>
                <p><strong>Diagnosa:</strong> {{ $item->diagnosa ?? '-' }}</p>
                <a href="{{ route('pemilik.rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
