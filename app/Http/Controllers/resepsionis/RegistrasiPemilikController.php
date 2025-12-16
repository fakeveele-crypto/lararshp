<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik; // <-- PASTIKAN ANDA MENGIMPOR MODEL PEMILIK
// use App\Models\User; // Mungkin dibutuhkan untuk relasi

class RegistrasiPemilikController extends Controller
{
    public function index() 
    { 
        $pemilik = Pemilik::with('user')->get(); 
 
        return view('resepsionis.regispemilik.indexregispem', compact('pemilik'));
    }

    public function store(Request $request) 
    {
        // Logika penyimpanan data Pemilik dan User di sini
        return redirect()->back()->with('success', 'Pemilik berhasil didaftarkan.'); 
    }
}