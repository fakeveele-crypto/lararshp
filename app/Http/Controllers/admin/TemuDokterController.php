<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Dokter;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temuDokter = TemuDokter::with('pet', 'dokter')->get();
        
        return view('admin.temudokter.indextemu', compact('temuDokter'));
    }

    public function create()
    {
        $pets = Pet::all();
        $dokters = Dokter::with('user')->get();
        return view('admin.temudokter.createtemu', compact('pets','dokters'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idpet' => 'nullable|integer',
            'iddokter' => 'nullable|integer',
            'id_dokter' => 'nullable|integer',
            'tanggal' => 'nullable|date',
            'waktu' => 'nullable|string',
            'keluhan' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        // map posted legacy 'iddokter' to DB column 'id_dokter' if present
        if (isset($data['iddokter']) && !isset($data['id_dokter'])) {
            $data['id_dokter'] = $data['iddokter'];
        }
        // ensure legacy key is not passed to Eloquent (DB column is id_dokter)
        if (isset($data['iddokter'])) {
            unset($data['iddokter']);
        }
        TemuDokter::create($data);
        return redirect()->route('admin.temu-dokter.index')->with('success','Janji temu dibuat');
    }

    public function edit($idtemu_dokter)
    {
        $item = TemuDokter::findOrFail($idtemu_dokter);
        return view('admin.temudokter.editemu', compact('item'));
    }

    public function update(Request $request, $idtemu_dokter)
    {
        $item = TemuDokter::findOrFail($idtemu_dokter);
        $data = $request->validate([
            'idpet'=>'nullable|integer',
            'iddokter'=>'nullable|integer',
            'id_dokter'=>'nullable|integer',
            'tanggal'=>'nullable|date',
            'waktu'=>'nullable|string',
            'keluhan'=>'nullable|string',
            'status'=>'nullable|string'
        ]);
        if (isset($data['iddokter']) && !isset($data['id_dokter'])) {
            $data['id_dokter'] = $data['iddokter'];
        }
        if (isset($data['iddokter'])) {
            unset($data['iddokter']);
        }
        $item->update($data);
        return redirect()->route('admin.temu-dokter.index')->with('success','Janji temu diperbarui');
    }

    public function destroy($idtemu_dokter)
    {
        $item = TemuDokter::findOrFail($idtemu_dokter);
        $item->delete();
        return redirect()->route('admin.temu-dokter.index')->with('success','Janji temu dihapus');
    }
}