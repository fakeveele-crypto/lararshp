<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet; // Pastikan Model Pet diimpor

class RegistrasiPetController extends Controller
{
    public function index()
    {
        // Ambil semua data Pet, dengan relasi ke Pemilik dan User pemilik
        $pets = Pet::with('pemilik.user')->get();
        
        // Panggil view yang baru kita buat
        return view('resepsionis.regispet.indexregispet', compact('pets')); // Menggunakan variabel $pets
    }
}