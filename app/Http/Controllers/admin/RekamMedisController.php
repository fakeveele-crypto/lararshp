<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\TemuDokter;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with('pet', 'dokter')->get();
        
        return view('admin.rekammedis.indexrekam', compact('rekamMedis'));
    }

    public function create()
    {
        $temuDokters = TemuDokter::with(['pet', 'dokter.user'])->orderBy('tanggal')->orderBy('waktu')->get();
        return view('admin.rekammedis.createrekam', compact('temuDokters'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
            'idtemu_dokter' => 'nullable|integer',
            'idreservasi_dokter' => 'nullable|integer',
        ]);
        // map submitted temu_dokter id to rekam_medis.idreservasi_dokter
        if (isset($data['idtemu_dokter']) && !isset($data['idreservasi_dokter'])) {
            $data['idreservasi_dokter'] = $data['idtemu_dokter'];
        }
        // if a temu_dokter was selected, populate idpet from that record
        if (isset($data['idreservasi_dokter'])) {
            $temu = TemuDokter::find($data['idreservasi_dokter']);
            if ($temu) {
                $data['idpet'] = $temu->idpet;
            } else {
                return redirect()->back()->withInput()->withErrors(['idtemu_dokter' => 'Janji temu tidak ditemukan']);
            }
        }
        if (isset($data['idtemu_dokter'])) {
            unset($data['idtemu_dokter']);
        }
        RekamMedis::create($data);
        return redirect()->route('admin.rekam-medis.index')->with('success','Rekam medis disimpan');
    }

    public function edit($idrekam_medis)
    {
        $item = RekamMedis::findOrFail($idrekam_medis);
        return view('admin.rekammedis.editrekam', compact('item'));
    }

    public function show($idrekam_medis)
    {
        $item = RekamMedis::with(['pet.pemilik.user','dokter.user','details.kodeTindakanTerapi'])->findOrFail($idrekam_medis);
        return view('admin.rekammedis.showrekam', compact('item'));
    }

    public function update(Request $request, $idrekam_medis)
    {
        $item = RekamMedis::findOrFail($idrekam_medis);
        $data = $request->validate(['anamnesa'=>'nullable|string','temuan_klinis'=>'nullable|string','diagnosa'=>'nullable|string','idpet'=>'nullable|integer']);
        $item->update($data);
        return redirect()->route('admin.rekam-medis.index')->with('success','Rekam medis diperbarui');
    }

    public function destroy($idrekam_medis)
    {
        $item = RekamMedis::findOrFail($idrekam_medis);
        $item->delete();
        return redirect()->route('admin.rekam-medis.index')->with('success','Rekam medis dihapus');
    }
}