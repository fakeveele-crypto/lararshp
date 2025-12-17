<?php
namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;

class PetController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::where('iduser', auth()->id())->firstOrFail();
        $pets = Pet::with('pemilik.user')->where('idpemilik', $pemilik->idpemilik)->get();
        return view('pemilik.pet.index', compact('pets'));
    }

    public function show($id)
    {
        $pemilik = Pemilik::where('iduser', auth()->id())->firstOrFail();
        $pet = Pet::with('pemilik.user')->where('idpemilik', $pemilik->idpemilik)->where('idpet', $id)->firstOrFail();
        return view('pemilik.pet.show', compact('pet'));
    }
}
