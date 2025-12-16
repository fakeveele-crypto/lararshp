<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\RekamMedis;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        // show Rekam Medis list in this index so user can add tindakan to a specific rekam
        $rekamMedis = RekamMedis::with('pet','dokter')->orderBy('created_at')->get();
        return view('admin.kodetindakanterapi.indexkode', compact('rekamMedis'));
    }

    public function create()
    {
        return view('admin.kodetindakanterapi.createkode');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|string',
            'nama_tindakan' => 'required|string',
            'biaya' => 'nullable|numeric',
        ]);
        KodeTindakanTerapi::create($data);
        return redirect()->route('admin.kode-tindakan-terapi.index')->with('success', 'Data tindakan ditambahkan');
    }

    public function edit($idkode_tindakan_terapi)
    {
        $item = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
        return view('admin.kodetindakanterapi.editkode', compact('item'));
    }

    public function update(Request $request, $idkode_tindakan_terapi)
    {
        $item = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
        $data = $request->validate(['kode' => 'required|string','nama_tindakan'=>'required|string','biaya'=>'nullable|numeric']);
        $item->update($data);
        return redirect()->route('admin.kode-tindakan-terapi.index')->with('success', 'Data tindakan diperbarui');
    }

    public function destroy($idkode_tindakan_terapi)
    {
        $item = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
        $item->delete();
        return redirect()->route('admin.kode-tindakan-terapi.index')->with('success', 'Data tindakan dihapus');
    }
}