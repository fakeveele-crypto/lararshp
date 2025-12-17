@extends('layouts.lte.main')

@push('styles')
    <style>
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
        .container-view { width: 95%; margin: 50px auto; }
        .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
    </style>
@endpush

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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
