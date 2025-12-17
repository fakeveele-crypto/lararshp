@extends('layouts.lte.main')

@section('content')
<div class="container-view">
    <h2 class="text-start">Dashboard Dokter</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Recent Rekam Medis</div>
                <div class="card-body">
                    <p>Ringkasan rekam medis terbaru (sesuaikan sesuai kebutuhan dokter).</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Janji Temu</div>
                <div class="card-body">
                    <p>Ringkasan janji temu yang perlu ditindaklanjuti.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
