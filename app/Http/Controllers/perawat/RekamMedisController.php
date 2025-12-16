<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with('pet', 'dokter')
                                ->orderBy('tanggal_periksa', 'desc')
                                ->limit(50) 
                                ->get();
        
        return view('perawat.rekam-medis.index', compact('rekamMedis'));
    }
    
    public function show($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with('pet', 'dokter')
                                ->findOrFail($idrekam_medis);
        
        return view('perawat.rekam-medis.show', compact('rekamMedis'));
    }
}