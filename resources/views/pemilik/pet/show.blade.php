@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <div class="card">
            <div class="card-header">Detail Pet: {{ optional($pet)->nama }}</div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $pet->nama }}</p>
                <p><strong>Pemilik:</strong> {{ optional(optional($pet->pemilik)->user)->nama }}</p>
                <a href="{{ route('pemilik.pet.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
