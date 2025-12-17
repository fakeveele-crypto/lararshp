<?php
namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pemilik;
use App\Models\Pet;

class TemuDokterController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::where('iduser', auth()->id())->firstOrFail();
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet')->toArray();
        $temu = TemuDokter::with(['pet','dokter.user'])->whereIn('idpet', $petIds)->orderBy('tanggal','desc')->get();
        return view('pemilik.temudokter.index', compact('temu'));
    }

    public function show($id)
    {
        $pemilik = Pemilik::where('iduser', auth()->id())->firstOrFail();
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet')->toArray();
        $temu = TemuDokter::with(['pet','dokter.user'])->whereIn('idpet', $petIds)->where('idtemu_dokter', $id)->firstOrFail();
        return view('pemilik.temudokter.show', compact('temu'));
    }
}
