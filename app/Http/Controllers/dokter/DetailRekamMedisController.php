<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailRekamMedis;
use App\Models\RekamMedis;
use App\Models\KodeTindakanTerapi;

class DetailRekamMedisController extends Controller
{
    public function create($idrekam)
    {
        $rekam = RekamMedis::findOrFail($idrekam);
        $kodetindakan = KodeTindakanTerapi::orderBy('kode')->get();
        return view('dokter.detailrekammedis.create', compact('rekam','kodetindakan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idrekam_medis' => 'required|integer|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000',
        ]);

        DetailRekamMedis::create($data);

        return redirect()->route('dokter.rekam-medis.show', $data['idrekam_medis'])->with('success','Tindakan ditambahkan ke rekam medis');
    }

    public function edit($iddetail)
    {
        $detail = DetailRekamMedis::with('kodeTindakanTerapi')->findOrFail($iddetail);
        $kodetindakan = KodeTindakanTerapi::orderBy('kode')->get();
        return view('dokter.detailrekammedis.edit', compact('detail','kodetindakan'));
    }

    public function update(Request $request, $iddetail)
    {
        $detail = DetailRekamMedis::findOrFail($iddetail);
        $data = $request->validate([
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000',
        ]);

        $detail->update($data);

        return redirect()->route('dokter.rekam-medis.show', $detail->idrekam_medis)->with('success','Tindakan diperbarui');
    }

    public function destroy($iddetail)
    {
        $detail = DetailRekamMedis::findOrFail($iddetail);
        $idrekam = $detail->idrekam_medis;
        $detail->delete();
        return redirect()->route('dokter.rekam-medis.show', $idrekam)->with('success','Tindakan dihapus');
    }

    // Complete rekam medis: mark related temu_dokter status as Selesai
    public function complete($idrekam)
    {
        $rekam = RekamMedis::with('reservasi')->findOrFail($idrekam);

        // If RekamMedis is linked to a TemuDokter via idreservasi_dokter, use it
        if ($rekam->reservasi) {
            $rekam->reservasi->status = 'Selesai';
            $rekam->reservasi->save();
            return redirect()->route('dokter.rekam-medis.index')->with('success','Rekam medis diselesaikan dan janji temu ditandai Selesai');
        }

        // Fallback: try to find a matching TemuDokter by pet (recent, not already Selesai)
        if (!empty($rekam->idpet)) {
            $temu = \App\Models\TemuDokter::where('idpet', $rekam->idpet)
                        ->where(function($q){ $q->whereNull('status')->orWhere('status','<>','Selesai'); })
                        ->orderBy('tanggal','desc')
                        ->orderBy('waktu','desc')
                        ->first();

            if ($temu) {
                $temu->status = 'Selesai';
                $temu->save();
                return redirect()->route('dokter.rekam-medis.index')->with('success','Rekam medis diselesaikan dan janji temu terkait ditandai Selesai (fallback)');
            }
        }

        // Nothing to update
        return redirect()->route('dokter.rekam-medis.index')->with('warning','Rekam medis diselesaikan, namun tidak ditemukan janji temu terkait untuk diperbarui');
    }
}
