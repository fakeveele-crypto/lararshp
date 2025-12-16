<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        
        return view('admin.kategori.indexkategori', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.createkategori');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);
        Kategori::create($data);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori ditambahkan');
    }

    public function edit($idkategori)
    {
        $kategori = Kategori::findOrFail($idkategori);
        return view('admin.kategori.editkategori', compact('kategori'));
    }

    public function update(Request $request, $idkategori)
    {
        $kategori = Kategori::findOrFail($idkategori);
        $data = $request->validate(['nama_kategori' => 'required|string', 'deskripsi' => 'nullable|string']);
        $kategori->update($data);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori diperbarui');
    }

    public function destroy($idkategori)
    {
        $kategori = Kategori::findOrFail($idkategori);
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori dihapus');
    }
}