<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function index()
    {   
        $idpemilik = 101; 

        $rekamMedis = RekamMedis::whereHas('pet', function ($query) use ($idpemilik) {
                                    $query->where('idpemilik', $idpemilik);
                                })
                                ->with('pet', 'dokter')
                                ->orderBy('tanggal_periksa', 'desc')
                                ->get();
        
        return view('pemilik.rekam-medis.index', compact('rekamMedis'));
    }

    public function show($idrekam_medis)
    {
        $idpemilik = 101; 
        
        $rekamMedis = RekamMedis::whereHas('pet', function ($query) use ($idpemilik) {
                                    $query->where('idpemilik', $idpemilik);
                                })
                                ->with('pet', 'dokter')
                                ->findOrFail($idrekam_medis);
        
        return view('pemilik.rekam-medis.show', compact('rekamMedis'));
    }
}