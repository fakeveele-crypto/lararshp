<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'dokter.user', 'details.kodeTindakanTerapi', 'reservasi'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('perawat.rekammedis.indexrekam', compact('rekamMedis'));
    }

    public function show($id)
    {
        $item = RekamMedis::with(['pet.pemilik.user', 'dokter.user', 'details.kodeTindakanTerapi', 'reservasi'])
                    ->findOrFail($id);

        return view('perawat.rekammedis.showrekam', compact('item'));
    }

    public function edit($id)
    {
        $item = RekamMedis::findOrFail($id);
        return view('perawat.rekammedis.editrekam', compact('item'));
    }

    public function create()
    {
        // provide lists for selects
        $temu = \App\Models\TemuDokter::with(['pet','dokter.user'])
                    ->whereIn('status', ['Pending', 'Selesai'])
                    ->orderBy('tanggal','asc')
                    ->get();

        // only pets that have a matching TemuDokter (Pending or Selesai)
        $petIds = $temu->pluck('idpet')->unique()->filter()->values()->all();
        $pets = \App\Models\Pet::with('pemilik.user')
                    ->whereIn('idpet', $petIds)
                    ->get();

        return view('perawat.rekammedis.createrekam', compact('pets','temu'));
    }

    public function update(Request $request, $id)
    {
        $item = RekamMedis::findOrFail($id);
        $data = $request->validate([
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
        ]);

        $item->update($data);

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis diperbarui');
    }

    public function destroy($id)
    {
        $item = RekamMedis::findOrFail($id);
        $item->delete();

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis dihapus');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idpet' => 'required|integer|exists:pet,idpet',
            'idreservasi_dokter' => 'nullable|integer|exists:temu_dokter,idtemu_dokter',
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
        ]);

        // set created_at if desired
        $data['created_at'] = now();

        RekamMedis::create($data);

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }
}