<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Schema;

class RekamMedisController extends Controller
{
    public function index()
    {
        // Only show RekamMedis where related temu_dokter.status = 'Pending'
        if (Schema::hasColumn('rekam_medis', 'idreservasi_dokter')) {
            $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'dokter.user', 'details.kodeTindakanTerapi', 'reservasi'])
                            ->whereHas('reservasi', function($q){
                                $q->where('status','Pending');
                            })
                            ->orderBy('created_at','desc')
                            ->get();
        } else {
            // Fallback: join via pet -> temu_dokter to find pending appointments
            $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'dokter.user', 'details.kodeTindakanTerapi', 'reservasi'])
                            ->join('temu_dokter', 'temu_dokter.idpet', '=', 'rekam_medis.idpet')
                            ->where('temu_dokter.status','Pending')
                            ->select('rekam_medis.*')
                            ->distinct()
                            ->orderBy('rekam_medis.created_at','desc')
                            ->get();
        }

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
        // provide lists for selects — only reservations with status 'Pending'
        $temu = \App\Models\TemuDokter::with(['pet','dokter.user'])
                    ->where('status', 'Pending')
                    ->orderBy('tanggal','asc')
                    ->get();

        // only pets that have a matching TemuDokter (Pending)
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