@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Pet</h3></div>
            <div class="card-body">
                <form action="{{ route('resepsionis.datapet.update', $item->idpet) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna / Tanda</label>
                        <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda', $item->warna_tanda) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-</option>
                            <option value="L" {{ (old('jenis_kelamin', $item->jenis_kelamin) == 'L') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ (old('jenis_kelamin', $item->jenis_kelamin) == 'P') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pemilik</label>
                        @if(!empty($pemiliks) && count($pemiliks))
                            <select name="idpemilik" id="idpemilik" class="form-control" required>
                                <option value="">-</option>
                                @foreach($pemiliks as $pm)
                                    <option value="{{ $pm->idpemilik }}" {{ (old('idpemilik', $item->idpemilik) == $pm->idpemilik) ? 'selected' : '' }}>{{ $pm->user->nama ?? 'Pemilik #' . $pm->idpemilik }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="idpemilik" class="form-control" value="{{ old('idpemilik', $item->idpemilik) }}">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Hewan</label>
                        @if(!empty($jenisHewans) && count($jenisHewans))
                            <select name="idjenis_hewan" id="idjenis_hewan" class="form-control" required>
                                <option value="">-</option>
                                @foreach($jenisHewans as $j)
                                    <option value="{{ $j->idjenis_hewan }}" {{ (old('idjenis_hewan', $item->idjenis_hewan) == $j->idjenis_hewan) ? 'selected' : '' }}>{{ $j->nama_jenis_hewan }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="idjenis_hewan" class="form-control" value="{{ old('idjenis_hewan', $item->idjenis_hewan) }}">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ras</label>
                        @if(!empty($rasHewans) && count($rasHewans))
                            @php
                                $__jenisMap = [];
                                if(!empty($jenisHewans)){
                                    foreach($jenisHewans as $__j){ $__jenisMap[$__j->idjenis_hewan] = $__j->nama_jenis_hewan; }
                                }
                            @endphp
                            <select name="idras_hewan" id="idras_hewan" class="form-control" required>
                                <option value="">-</option>
                                @foreach($rasHewans as $r)
                                    @php $__jenisNama = $__jenisMap[$r->idjenis_hewan] ?? ''; @endphp
                                    <option value="{{ $r->idras_hewan }}" data-jenis="{{ $r->idjenis_hewan }}" {{ (old('idras_hewan', $item->idras_hewan) == $r->idras_hewan) ? 'selected' : '' }}>{{ $r->nama_ras }}{{ $__jenisNama ? ' (' . $__jenisNama . ')' : '' }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="idras_hewan" class="form-control" value="{{ old('idras_hewan', $item->idras_hewan) }}">
                        @endif
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('resepsionis.datapet.index') }}" class="btn btn-secondary">Batal</a>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function(){
                        var jenis = document.getElementById('idjenis_hewan');
                        var ras = document.getElementById('idras_hewan');
                        if (!jenis || !ras) return;
                        function filterRas(){
                            var val = jenis.value;
                            Array.from(ras.options).forEach(function(opt){
                                if (!opt.value) return; // skip placeholder
                                var matches = String(opt.dataset.jenis) === String(val) || !val;
                                opt.hidden = !matches;
                                opt.disabled = !matches;
                            });
                            if (ras.selectedOptions.length && ras.selectedOptions[0].hidden) ras.value = '';
                        }
                        jenis.addEventListener('change', filterRas);
                        filterRas();
                    });
                </script>
            </div>
        </div>
    </div>
@endsection

