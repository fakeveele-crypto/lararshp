@extends('layouts.lte.main')

@push('styles')
<style>
    body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
    h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
    .container-view { width: 90%; margin: 50px auto; }
    .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
    .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
    .table th { background-color: #f1f1f1; font-weight: 600; }
    .btn-aksi { padding: 5px 10px; font-size: 0.85rem; }
    .role-badge { background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-right: 5px; }
</style>
@endpush

@section('content')
    <div class="container-view">
        <h2 class="text-center">Data Pengguna Sistem (Users)</h2>

        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3 btn-aksi shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah User
        </a>

        <div class="card">
            <div class="card-header">Tabel Data Users</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->iduser }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @forelse ($user->roleUsers as $userRole)
                                            <span class="role-badge">{{ $userRole->role->nama_role ?? 'N/A' }}</span>
                                        @empty
                                            <span class="text-muted fst-italic">Role belum ditetapkan</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->iduser) }}" class="btn btn-warning btn-sm btn-aksi me-1" title="Edit Data User">Edit</a>
                                        <a href="#" class="btn btn-info text-white btn-sm btn-aksi me-1" title="Reset Password">Reset Pass</a>
                                        <form action="{{ route('admin.user.destroy', $user->iduser) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus User ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-aksi" title="Hapus User">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data Pengguna (User) yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Note: Pastikan model User dan relasi `roleUsers` sudah benar. --}}
            </div>
        </div>
    </div>
@endsection

{{-- scripts are provided by layouts/lte/scripts.blade.php (AdminLTE + Bootstrap) --}}