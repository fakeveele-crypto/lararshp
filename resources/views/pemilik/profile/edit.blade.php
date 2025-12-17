@extends('layouts.lte.main')

@section('content')
    <div class="container-view">
        <h2>Edit Profile</h2>
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('pemilik.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required />
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pemilik.dashboard') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
