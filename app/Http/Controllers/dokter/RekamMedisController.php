<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Schema;

class RekamMedisController extends Controller
{
    public function __construct()
    {
        // ensure middleware for dokter role is applied in routes; keep constructor minimal
    }

    public function index()
    {
        // show only rekam medis where related temu_dokter.status is 'Pending'
        // Some environments have inconsistent schema (missing idreservasi_dokter).
        if (Schema::hasColumn('rekam_medis', 'idreservasi_dokter')) {
            $rekamMedis = RekamMedis::with(['pet','reservasi.dokter.user'])
                            ->whereHas('reservasi', function($q){
                                $q->where('status', 'Pending');
                            })
                            ->orderBy('created_at','desc')
                            ->get();
        } else {
            // Fallback: join on temu_dokter via idpet to find pending appointments
            $rekamMedis = RekamMedis::with(['pet','reservasi.dokter.user'])
                            ->join('temu_dokter', 'temu_dokter.idpet', '=', 'rekam_medis.idpet')
                            ->where('temu_dokter.status', 'Pending')
                            ->select('rekam_medis.*')
                            ->distinct()
                            ->orderBy('rekam_medis.created_at','desc')
                            ->get();
        }

        return view('dokter.rekammedis.indexrekam', compact('rekamMedis'));
    }

    public function show($id)
    {
        $item = RekamMedis::with(['pet.pemilik.user','reservasi.dokter.user','details.kodeTindakanTerapi'])->findOrFail($id);
        return view('dokter.rekammedis.showrekam', compact('item'));
    }

    // Other actions (create/edit) are likely handled by perawat/admin; keep stubs for completeness
    public function create()
    {
        return view('dokter.rekammedis.createrekam');
    }

    public function store(Request $request)
    {
        $data = $request->validate([ 'anamnesa'=>'nullable|string','temuan_klinis'=>'nullable|string','diagnosa'=>'nullable|string','idpet'=>'required|integer',]);
        RekamMedis::create($data);
        return redirect()->route('dokter.rekam-medis.index')->with('success','Rekam medis disimpan');
    }

    public function edit($id)
    {
        $item = RekamMedis::findOrFail($id);
        return view('dokter.rekammedis.editrekam', compact('item'));
    }

    public function update(Request $request,$id)
    {
        $item = RekamMedis::findOrFail($id);
        $data = $request->validate(['anamnesa'=>'nullable|string','temuan_klinis'=>'nullable|string','diagnosa'=>'nullable|string']);
        $item->update($data);
        return redirect()->route('dokter.rekam-medis.index')->with('success','Rekam medis diperbarui');
    }

    public function destroy($id)
    {
        $item = RekamMedis::findOrFail($id);
        $item->delete();
        return redirect()->route('dokter.rekam-medis.index')->with('success','Rekam medis dihapus');
    }
}
