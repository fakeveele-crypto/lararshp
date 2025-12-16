<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user','dokter.user'])->orderBy('created_at','desc')->get();
        return view('resepsionis.rekam-medis.indexrekam', compact('rekamMedis'));
    }

    public function show($id)
    {
        $item = RekamMedis::with(['pet.pemilik.user','dokter.user','details.kodeTindakanTerapi'])->findOrFail($id);
        return view('resepsionis.rekam-medis.show', compact('item'));
    }
}
