@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header">Detail Janji Temu: {{ optional($temu->pet)->nama ?? '-' }}</div>
            <div class="card-body">
                <p><strong>Tanggal:</strong> {{ $temu->tanggal }} {{ $temu->waktu }}</p>
                <p><strong>Keluhan:</strong> {{ $temu->keluhan }}</p>
                <p><strong>Status:</strong> {{ $temu->status }}</p>
                <a href="{{ route('pemilik.temu-dokter.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
