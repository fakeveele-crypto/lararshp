<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis - Dokter</title>
    
    {{-- Impor Bootstrap CSS dan Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        /* Styling konsisten dengan site.css */
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        h2 { font-weight: 700; color: #007bff; margin-bottom: 20px; }
        .container-view { width: 95%; margin: 50px auto; }
        
        /* Styling Card dan Tabel */
        .card { border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background-color: #007bff; color: white; font-weight: 700; padding: 15px; }
        .table th { background-color: #f1f1f1; font-weight: 600; }
        .btn-aksi { padding: 5px 10px; font-size: 0.85rem; }
    </style>
</head>
<body>

    <div class="container-view">
        <h2 class="text-center">Daftar Rekam Medis (Area Dokter)</h2>
        <p class="text-center text-muted">Data ini mencakup riwayat pemeriksaan yang Anda tangani atau yang relevan.</p>

        <a href="#" class="btn btn-primary mb-3 btn-aksi shadow-sm">
            <i class="bi bi-file-earmark-plus me-1"></i> Buat Entri RM Baru
        </a>

        <div class="card">
            <div class="card-header">
                Tabel Data Rekam Medis
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>ID RM</th>
                                <th>Tgl. Periksa</th>
                                <th>Nama Hewan</th>
                                <th>Pemilik</th>
                                <th>Diagnosa Singkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Looping data dari variabel $rekamMedis yang dikirim oleh Dokter\RekamMedisController --}}
                            @forelse ($rekamMedis as $index => $rm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rm->idrekam_medis }}</td>
                                <td>{{ \Carbon\Carbon::parse($rm->tanggal_periksa)->format('d/m/Y') }}</td>
                                <td>{{ $rm->pet->nama_pet ?? 'N/A' }}</td>
                                <td>{{ $rm->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                                <td>
                                    <a href="#" class="btn btn-info text-white btn-sm btn-aksi me-1" title="Lihat Detail">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <a href="#" class="btn btn-warning btn-sm btn-aksi me-1" title="Edit/Update RM">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada data Rekam Medis yang ditemukan.</td>
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