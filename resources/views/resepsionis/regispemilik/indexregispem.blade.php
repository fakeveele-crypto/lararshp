<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Registrasi Pemilik (Resepsionis)</title>
    
    {{-- Impor Bootstrap CSS dan Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        /* Styling konsisten */
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
        .container-view { width: 95%; margin: 50px auto; }
        .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
        .table th { background-color: #f1f1f1; font-weight: 600; }
        .btn-aksi { padding: 5px 10px; font-size: 0.85rem; }
        .action-group { white-space: nowrap; }
    </style>
</head>
<body>

    <div class="container-view">
        <h2 class="text-center">Daftar Registrasi Pemilik Hewan</h2>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="#" class="btn btn-primary btn-aksi shadow-sm">
                <i class="bi bi-person-plus-fill me-1"></i> Registrasi Pemilik Baru
            </a>
            
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Cari Nama/Email Pemilik..." aria-label="Cari Pemilik">
                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                Tabel Data Pemilik Terdaftar
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Nama Pemilik</th>
                                <th>Email (User)</th>
                                <th>No WA</th>
                                <th>Alamat</th>
                                <th style="width: 25%;">Aksi Cepat</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- PENTING: Menggunakan variabel $regispemilik --}}
                            @forelse ($pemilik as $index => $item) 
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->user->nama ?? 'N/A' }}</td> 
                                <td>{{ $item->user->email ?? 'N/A' }}</td>
                                <td>{{ $item->no_wa }}</td>
                                <td>{{ Str::limit($item->alamat, 40) }}</td>
                                <td>
                                    <div class="action-group">
                                        <a href="#" class="btn btn-info text-white btn-sm btn-aksi me-1" title="Lihat Hewan">
                                            <i class="bi bi-paw-fill"></i> Pasien
                                        </a>
                                        <a href="#" class="btn btn-warning btn-sm btn-aksi me-1" title="Edit Data">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-success btn-sm btn-aksi" title="Buat Janji Temu">
                                            <i class="bi bi-calendar-plus"></i> Temu
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data Pemilik yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Bootstrap (Opsional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>