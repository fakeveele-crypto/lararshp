@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit Role</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.role.update', $item->idrole) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" name="nama_role" class="form-control" value="{{ old('nama_role', $item->nama_role) }}" required>
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
