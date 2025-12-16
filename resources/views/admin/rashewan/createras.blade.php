@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tambah Ras Hewan</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Ras</label>
                        <input type="text" name="nama_ras" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Hewan</label>
                        @if(!empty($jenis) && count($jenis))
                            <select name="idjenis_hewan" class="form-control" required>
                                <option value="">-</option>
                                @foreach($jenis as $j)
                                    <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="idjenis_hewan" class="form-control">
                        @endif
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
