@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $stats['pemiliks'] ?? 0 }}</h3>
                        <p>Data Pemilik</p>
                    </div>
                    <div class="icon"><i class="bi bi-people-fill"></i></div>
                    <a href="{{ route('resepsionis.datapemilik.index') }}" class="small-box-footer">Manage <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $stats['pets'] ?? 0 }}</h3>
                        <p>Data Pet</p>
                    </div>
                    <div class="icon"><i class="bi bi-paw"></i></div>
                    <a href="{{ route('resepsionis.datapet.index') }}" class="small-box-footer">Manage <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['appointments_total'] ?? 0 }}</h3>
                        <p>Janji Temu</p>
                    </div>
                    <div class="icon"><i class="bi bi-calendar-check"></i></div>
                    <a href="{{ route('resepsionis.temu-dokter.index') }}" class="small-box-footer">Manage <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info">
                    <div class="inner">
                        <h3>{{ $stats['appointments_today'] ?? 0 }}</h3>
                        <p>Janji Hari Ini</p>
                    </div>
                    <div class="icon"><i class="bi bi-clock-history"></i></div>
                    <a href="{{ route('resepsionis.temu-dokter.index') }}" class="small-box-footer">Lihat Jadwal <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-header">Upcoming Appointments</div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Pet</th>
                                    <th>Dokter</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcoming as $a)
                                    <tr>
                                        <td>{{ optional($a->pet)->nama ?? '-' }}</td>
                                        <td>{{ optional(optional($a->dokter)->user)->nama ?? '-' }}</td>
                                        <td>{{ optional(\Carbon\Carbon::parse($a->tanggal))->format('d/m/Y') ?? '-' }}</td>
                                        <td>{{ $a->waktu ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center">No upcoming appointments</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">Quick Actions</div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('resepsionis.datapemilik.index') }}" class="btn btn-secondary">Data Pemilik</a>
                            <a href="{{ route('resepsionis.datapet.index') }}" class="btn btn-info">Data Pet</a>
                            <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-warning">Janji Temu</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Help</div>
                    <div class="card-body text-muted">
                        Use this dashboard to manage owners, pets and appointments. Click buttons for quick access.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .small-box { padding: 1rem; border-radius: .5rem; color: white; }
    .small-box .inner h3 { font-size: 1.6rem; margin: 0; }
    .small-box .icon { position: absolute; top: 10px; right: 10px; opacity: .15; font-size: 3rem; }
    .small-box-footer { display: block; margin-top: .5rem; color: rgba(255,255,255,.9); }
</style>
@endpush
