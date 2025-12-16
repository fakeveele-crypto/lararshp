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
        // determine dokter id from authenticated user if possible
        $dokterId = 1;
        if(\Illuminate\Support\Facades\Auth::check()){
            $user = \Illuminate\Support\Facades\Auth::user();
            if(method_exists($user, 'dokter') && $user->dokter){
                $dokterId = $user->dokter->id_dokter ?? $dokterId;
            }
        }

        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user', // Hewan -> Pemilik -> User
            'dokter'           // Relasi ke Dokter jika ada
        ])
        ->whereHas('reservasi', function ($query) use ($dokterId) {

            // TemuDokter table uses column name `id_dokter` (with underscore)
            $query->where('id_dokter', $dokterId);
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