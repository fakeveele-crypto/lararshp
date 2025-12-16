<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik.user')->get();
        return view('resepsionis.pet.index', compact('pets'));
    }

    public function create()
    {
        $pemiliks = Pemilik::with('user')->get();
        $jenisHewans = JenisHewan::all();
        $rasHewans = RasHewan::all();
        return view('resepsionis.pet.create', compact('pemiliks', 'jenisHewans', 'rasHewans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idpemilik' => 'required|integer|exists:pemilik,idpemilik',
            'nama' => 'required|string|max:191',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:191',
            'jenis_kelamin' => 'nullable|in:L,P',
            'idjenis_hewan' => 'nullable|integer|exists:jenis_hewan,idjenis_hewan',
            'idras_hewan' => 'nullable|integer|exists:ras_hewan,idras_hewan',
        ]);

        Pet::create($data);

        return redirect()->route('resepsionis.datapet.index')->with('success', 'Pet disimpan');
    }

    public function edit($id)
    {
        $item = Pet::findOrFail($id);
        $pemiliks = Pemilik::with('user')->get();
        $jenisHewans = JenisHewan::all();
        $rasHewans = RasHewan::all();
        return view('resepsionis.pet.edit', compact('item', 'pemiliks', 'jenisHewans', 'rasHewans'));
    }

    public function update(Request $request, $id)
    {
        $item = Pet::findOrFail($id);
        $data = $request->validate([
            'idpemilik' => 'required|integer|exists:pemilik,idpemilik',
            'nama' => 'required|string|max:191',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:191',
            'jenis_kelamin' => 'nullable|in:L,P',
            'idjenis_hewan' => 'nullable|integer|exists:jenis_hewan,idjenis_hewan',
            'idras_hewan' => 'nullable|integer|exists:ras_hewan,idras_hewan',
        ]);

        $item->update($data);

        return redirect()->route('resepsionis.datapet.index')->with('success', 'Pet diperbarui');
    }

    public function destroy($id)
    {
        $item = Pet::findOrFail($id);
        $item->delete();
        return redirect()->route('resepsionis.datapet.index')->with('success', 'Pet dihapus');
    }
}
