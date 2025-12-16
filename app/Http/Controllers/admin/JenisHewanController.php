<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// PENTING: Pastikan Anda sudah mengimpor Model JenisHewan di sini!
use App\Models\JenisHewan; 

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenishewan = JenisHewan::all(); 
        return view('admin.jenishewan.indexjenishewan', compact('jenishewan'));
    }

    public function create()
    {
        return view('admin.jenishewan.createjenishewan');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jenis_hewan' => 'required|string',
        ]);
        JenisHewan::create($data);
        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan berhasil ditambahkan');
    }

    public function edit($idjenis_hewan)
    {
        $jenis = JenisHewan::findOrFail($idjenis_hewan);
        return view('admin.jenishewan.editjenishewan', compact('jenis'));
    }

    public function update(Request $request, $idjenis_hewan)
    {
        $jenis = JenisHewan::findOrFail($idjenis_hewan);
        $data = $request->validate(['nama_jenis_hewan' => 'required|string']);
        $jenis->update($data);
        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan diperbarui');
    }

    public function destroy($idjenis_hewan)
    {
        $jenis = JenisHewan::findOrFail($idjenis_hewan);
        $jenis->delete();
        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan dihapus');
    }
}