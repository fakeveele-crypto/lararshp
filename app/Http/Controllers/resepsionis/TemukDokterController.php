<?php
namespace App\Http\Controllers\Resepsionis;
use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Dokter;
class TemuDokterController extends Controller
{
    public function index() 
    {
         $janjiTemu = TemuDokter::with('pet', 'dokter')->orderBy('tanggal_janji', 'asc')->get(); 
         return view('resepsionis.temu-dokter.index', compact('janjiTemu')); 
    }

    public function create() 
    {
         $pets = Pet::all(); $dokters = Dokter::all(); 
         return view('resepsionis.temu-dokter.create', compact('pets', 'dokters')); 
    }

    public function store(Request $request) 
    {  
        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Janji temu berhasil dijadwalkan.'); 
    }
}