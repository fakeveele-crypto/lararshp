@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Janji Temu Dokter</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.temu-dokter.update', $item->idtemu_dokter) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="" {{ old('status', $item->status) == '' ? 'selected' : '' }}>-</option>
                            <option value="Menunggu" {{ old('status', $item->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Diproses" {{ old('status', $item->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ old('status', $item->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ old('status', $item->status) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
