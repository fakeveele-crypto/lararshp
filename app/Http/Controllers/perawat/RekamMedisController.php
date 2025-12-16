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
}