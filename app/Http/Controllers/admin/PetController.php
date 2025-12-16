<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Pemilik;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik', 'jenisHewan', 'ras')->get();
        
        return view('admin.pet.indexpet', compact('pets'));
    }

    public function create()
    {
        $jenisHewans = JenisHewan::all();
        $rasHewans = RasHewan::all();
        $pemiliks = Pemilik::with('user')->get();
        return view('admin.pet.createpet', compact('jenisHewans', 'rasHewans', 'pemiliks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idpemilik' => 'nullable|integer',
            'nama' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'idras_hewan' => 'nullable|integer',
            'idjenis_hewan' => 'nullable|integer',
        ]);
        // `idjenis_hewan` is used only for client-side filtering; the `pet` table stores `idras_hewan`.
        Pet::create($data);
        return redirect()->route('admin.pet.index')->with('success', 'Pet disimpan');
    }

    public function edit($idpet)
    {
        $pet = Pet::findOrFail($idpet);
        return view('admin.pet.editpet', compact('pet'));
    }

    public function update(Request $request, $idpet)
    {
        $pet = Pet::findOrFail($idpet);
        $data = $request->validate(['idpemilik'=>'nullable|integer','nama'=>'required|string','tanggal_lahir'=>'nullable|date','warna_tanda'=>'nullable|string','jenis_kelamin'=>'nullable|string','idras_hewan'=>'nullable|integer','idjenis_hewan' => 'nullable|integer']);
        $pet->update($data);
        return redirect()->route('admin.pet.index')->with('success','Pet diperbarui');
    }

    public function destroy($idpet)
    {
        $pet = Pet::findOrFail($idpet);
        $pet->delete();
        return redirect()->route('admin.pet.index')->with('success','Pet dihapus');
    }
}