@extends('layouts.lte.main')

@section('content')
    <div class="container-view p-3">
        <div class="card">
            <div class="card-header">Detail Rekam Medis</div>
            <div class="card-body">
                <h4>Informasi Pasien</h4>
                <p><strong>Hewan:</strong> {{ optional($item->pet)->nama ?? '-' }}</p>
                <p><strong>Pemilik:</strong> {{ optional(optional($item->pet)->pemilik)->user->nama ?? '-' }}</p>
                <p><strong>Dokter:</strong> {{ optional(optional($item->dokter)->user)->nama ?? '-' }}</p>

                <hr />
                <h5>Anamnesa</h5>
                <p>{{ $item->anamnesa ?? '-' }}</p>

                <h5>Temuan Klinis</h5>
                <p>{{ $item->temuan_klinis ?? '-' }}</p>

                <h5>Diagnosa</h5>
                <p>{{ $item->diagnosa ?? '-' }}</p>

                <h5>Detail Tindakan</h5>
                <ul>
                    @forelse($item->details ?? [] as $d)
                        <li>
                            @php
                                $kode = optional($d->kodeTindakanTerapi)->kode;
                                $deskripsi = optional($d->kodeTindakanTerapi)->deskripsi_tindakan_terapi;
                                $detailText = $d->detail ?? null;
                            @endphp
                            @if($kode)
                                <strong>{{ $kode }}</strong>@if($deskripsi) - {{ $deskripsi }}@endif
                                @if($detailText)
                                    <div class="small text-muted">Catatan: {{ $detailText }}</div>
                                @endif
                            @else
                                {{ $detailText ?? '-' }}
                            @endif
                        </li>
                    @empty
                        <li class="text-muted">Tidak ada tindakan tercatat.</li>
                    @endforelse
                </ul>

                <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
