<?php
namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\Pemilik;
use App\Models\Pet;

class RekamMedisController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::where('iduser', auth()->id())->firstOrFail();
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet')->toArray();
        $rekamMedis = RekamMedis::with(['pet.pemilik.user','details.kodeTindakanTerapi','reservasi'])
                        ->whereIn('idpet', $petIds)
                        ->orderBy('created_at','desc')
                        ->get();
        return view('pemilik.rekammedis.index', compact('rekamMedis'));
    }

    public function show($id)
    {
        $pemilik = Pemilik::where('iduser', auth()->id())->firstOrFail();
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet')->toArray();
        $item = RekamMedis::with(['pet.pemilik.user','details.kodeTindakanTerapi','reservasi'])
                ->whereIn('idpet', $petIds)
                ->where('idrekam_medis', $id)
                ->firstOrFail();
        return view('pemilik.rekammedis.show', compact('item'));
    }
}