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
        <h2 class="text-center">Detail Rekam Medis</h2>
        <div class="card">
            <div class="card-header">Detail Rekam Medis #{{ $item->idrekam_medis }}</div>
            <div class="card-body">
                <p><strong>Nama Hewan:</strong> {{ optional($item->pet)->nama ?? 'N/A' }}</p>
                <p><strong>Pemilik:</strong> {{ optional(optional(optional($item->pet)->pemilik)->user)->nama ?? 'N/A' }}</p>
                <p><strong>Anamnesa:</strong> {{ $item->anamnesa ?? '-' }}</p>
                <p><strong>Temuan Klinis:</strong> {{ $item->temuan_klinis ?? '-' }}</p>
                <p><strong>Diagnosa:</strong> {{ $item->diagnosa ?? '-' }}</p>
                <div class="mb-3">
                    <a href="{{ route('dokter.detail-rekam-medis.create', $item->idrekam_medis) }}" class="btn btn-primary">Tambah Tindakan</a>
                    <a href="{{ route('dokter.rekam-medis.edit', $item->idrekam_medis) }}" class="btn btn-outline-primary ms-2">Edit Rekam Medis</a>
                    <form method="POST" action="{{ route('dokter.rekam-medis.complete', $item->idrekam_medis) }}" class="d-inline-block ms-2">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('Tandai rekam medis ini selesai?')">Selesaikan</button>
                    </form>

                    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                </div>

                <h5>Detail Tindakan</h5>
                <ul>
                    @forelse($item->details ?? [] as $d)
                        <li class="mb-2">
                            @php
                                $kode = optional($d->kodeTindakanTerapi)->kode;
                                $deskripsi = optional($d->kodeTindakanTerapi)->deskripsi_tindakan_terapi;
                                $detailText = $d->detail ?? null;
                            @endphp
                            <div>
                                @if($kode)
                                    <strong>{{ $kode }}</strong>@if($deskripsi) - {{ $deskripsi }}@endif
                                @else
                                    {{ $detailText ?? '-' }}
                                @endif
                            </div>
                            @if($detailText)
                                <div class="small text-muted">Catatan: {{ $detailText }}</div>
                            @endif

                            <div class="mt-1">
                                <a href="{{ route('dokter.detail-rekam-medis.edit', $d->iddetail_rekam_medis) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                                <form method="POST" action="{{ route('dokter.detail-rekam-medis.destroy', $d->iddetail_rekam_medis) }}" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus tindakan ini?')">Hapus</button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="text-muted">Tidak ada tindakan tercatat.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
