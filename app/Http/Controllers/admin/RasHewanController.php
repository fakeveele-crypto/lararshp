<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan; // Pastikan ini diimpor jika digunakan

class RasHewanController extends Controller
{
    public function index()
    {
        // Wajib: Muat relasi 'jenisHewan'
        $rasHewan = RasHewan::with('jenisHewan')->get(); 
        
        return view('admin.rashewan.indexras', compact('rasHewan')); 
    }
    public function create()
    {
        $jenis = JenisHewan::all();
        return view('admin.rashewan.createras', compact('jenis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_ras' => 'required|string',
            'idjenis_hewan' => 'nullable|integer',
        ]);
        RasHewan::create($data);
        return redirect()->route('admin.ras-hewan.index')->with('success','Ras hewan ditambahkan');
    }

    public function edit($idras_hewan)
    {
        $item = RasHewan::findOrFail($idras_hewan);
        $jenis = JenisHewan::all();
        return view('admin.rashewan.editras', compact('item','jenis'));
    }

    public function update(Request $request, $idras_hewan)
    {
        $item = RasHewan::findOrFail($idras_hewan);
        $data = $request->validate(['nama_ras'=>'required|string','idjenis_hewan'=>'nullable|integer']);
        $item->update($data);
        return redirect()->route('admin.ras-hewan.index')->with('success','Ras hewan diperbarui');
    }

    public function destroy($idras_hewan)
    {
        $item = RasHewan::findOrFail($idras_hewan);
        $item->delete();
        return redirect()->route('admin.ras-hewan.index')->with('success','Ras hewan dihapus');
    }
}