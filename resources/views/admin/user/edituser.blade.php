@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Edit User</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="idrole" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            @php $currentRole = optional($user->roleUsers->first())->idrole; @endphp
                            @foreach($roles as $role)
                                <option value="{{ $role->idrole }}" {{ $currentRole == $role->idrole ? 'selected' : '' }}>{{ $role->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
