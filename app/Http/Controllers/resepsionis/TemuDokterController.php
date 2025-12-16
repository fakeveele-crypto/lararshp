<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Dokter;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temuDokter = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('resepsionis.temudokter.indextemu', compact('temuDokter'));
    }

    public function create()
    {
        $pets = Pet::all();
        $dokters = Dokter::all();

        return view('resepsionis.temudokter.create', compact('pets', 'dokters'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idpet' => 'required|integer|exists:pet,idpet',
            'id_dokter' => 'required|integer|exists:dokter,id_dokter',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'keluhan' => 'nullable|string|max:2000',
        ]);

        // default status when scheduling
        $data['status'] = $request->input('status', 'Menunggu');

        TemuDokter::create($data);

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Janji temu berhasil dijadwalkan.');
    }
}