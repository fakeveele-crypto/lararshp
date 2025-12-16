<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        
        return view('admin.kategoriklinis.indexklinis', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategoriklinis.createklinis');
    }

    public function store(Request $request)
    {
        $data = $request->validate([ 'nama_kategori_klinis' => 'required|string' ]);
        KategoriKlinis::create($data);
        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Kategori klinis ditambahkan');
    }

    public function edit($idkategori_klinis)
    {
        $item = KategoriKlinis::findOrFail($idkategori_klinis);
        return view('admin.kategoriklinis.editklinis', compact('item'));
    }

    public function update(Request $request, $idkategori_klinis)
    {
        $item = KategoriKlinis::findOrFail($idkategori_klinis);
        $data = $request->validate([ 'nama_kategori_klinis' => 'required|string' ]);
        $item->update($data);
        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Kategori klinis diperbarui');
    }

    public function destroy($idkategori_klinis)
    {
        $item = KategoriKlinis::findOrFail($idkategori_klinis);
        $item->delete();
        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Kategori klinis dihapus');
    }
}