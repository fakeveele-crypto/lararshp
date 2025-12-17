@extends('layouts.lte.main')

@section('content')
<div class="container-view">
    <div class="card">
        <div class="card-header">Detail Rekam Medis #{{ $item->idrekam_medis }}</div>
        <div class="card-body">
            <p><strong>Nama Hewan:</strong> {{ optional($item->pet)->nama ?? 'N/A' }}</p>
            <p><strong>Pemilik:</strong> {{ optional(optional(optional($item->pet)->pemilik)->user)->nama ?? 'N/A' }}</p>
            <p><strong>Anamnesa:</strong> {{ $item->anamnesa ?? '-' }}</p>
            <p><strong>Temuan Klinis:</strong> {{ $item->temuan_klinis ?? '-' }}</p>
            <p><strong>Diagnosa:</strong> {{ $item->diagnosa ?? '-' }}</p>
            <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
