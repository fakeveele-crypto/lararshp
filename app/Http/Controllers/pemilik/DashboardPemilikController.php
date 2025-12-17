<?php
namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RekamMedis;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $pemilik = Pemilik::where('iduser', $userId)->first();
        $petCount = 0; $temuCount = 0; $rekamCount = 0;
        if ($pemilik) {
            $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet')->toArray();
            $petCount = count($petIds);
            $temuCount = TemuDokter::whereIn('idpet', $petIds)->count();
            $rekamCount = RekamMedis::whereIn('idpet', $petIds)->count();
        }

        return view('pemilik.dashboard', compact('petCount','temuCount','rekamCount'));
    }
}
