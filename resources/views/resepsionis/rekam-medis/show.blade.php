@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Detail Rekam Medis #{{ $item->idrekam_medis }}</h3></div>
            <div class="card-body">
                <div class="mb-3"><strong>Nama Hewan:</strong> {{ $item->pet->nama ?? 'N/A' }}</div>
                <div class="mb-3"><strong>Anamnesa:</strong><p class="border rounded p-2">{{ $item->anamnesa ?? '-' }}</p></div>
                <div class="mb-3"><strong>Temuan Klinis:</strong><p class="border rounded p-2">{{ $item->temuan_klinis ?? '-' }}</p></div>
                <div class="mb-3"><strong>Diagnosa:</strong><p class="border rounded p-2">{{ $item->diagnosa ?? '-' }}</p></div>

                <a href="{{ route('resepsionis.rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
