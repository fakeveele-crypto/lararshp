<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailRekamMedis;
use App\Models\RekamMedis;
use App\Models\KodeTindakanTerapi;

class DetailRekamMedisController extends Controller
{
    public function create(Request $request)
    {
        $idkode = $request->query('idkode');
        $idrekam = $request->query('idrekam');
        $rekamMedis = RekamMedis::with('pet')->orderBy('created_at')->get();
        $kodes = KodeTindakanTerapi::with('kategoriKlinis')->get()->groupBy(function($k){
            return $k->kategoriKlinis->nama_kategori_klinis ?? 'Umum';
        });
        return view('admin.detailrekammedis.createdetail', compact('rekamMedis','kodes','idkode','idrekam'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idrekam_medis' => 'required|integer',
            'idkode_tindakan_terapi' => 'required|integer',
            'detail' => 'nullable|string'
        ]);

        DetailRekamMedis::create($data);
        return redirect()->route('admin.rekam-medis.index')->with('success','Tindakan berhasil ditambahkan ke rekam medis');
    }

}
