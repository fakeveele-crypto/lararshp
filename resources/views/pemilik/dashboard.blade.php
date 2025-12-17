@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <h2 class="text-start">Dashboard Pemilik</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">My Pets</div>
                    <div class="card-body">
                        <h3>{{ $petCount }}</h3>
                        <p>Jumlah hewan yang Anda miliki.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Janji Temu</div>
                    <div class="card-body">
                        <h3>{{ $temuCount }}</h3>
                        <p>Jumlah janji temu terkait hewan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Rekam Medis</div>
                    <div class="card-body">
                        <h3>{{ $rekamCount }}</h3>
                        <p>Jumlah rekam medis untuk hewan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
