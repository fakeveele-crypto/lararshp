<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class RekamMedisController extends Controller
{
    public function index()
    {
        $dokterId = 1; 

        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user', // Hewan -> Pemilik -> User
            'dokter'           // Relasi ke Dokter jika ada
        ])
        ->whereHas('reservasi', function ($query) use ($dokterId) {

            $query->where('iddokter', $dokterId); 
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('dokter.rekam-medis.indexrekammedis', compact('rekamMedis'));
    }

    public function show($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user', 
            'dokter'
        ])->findOrFail($idrekam_medis);

        return view('dokter.rekam-medis.show', compact('rekamMedis'));
    }
}