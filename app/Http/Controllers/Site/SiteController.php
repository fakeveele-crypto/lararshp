<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function layanan()
    {
        return view('site.layanan');
    }

    public function struktur()
    {
        return view('site.struktur');
    }

    public function visimisi()
    {
        return view('site.visimisi');
    }

    public function cekKoneksi()
    {
        try {
            \DB::connection()->getPdo(); // Sekarang PHP tahu bahwa DB adalah Facade
            return 'Koneksi ke database berhasil!';
        } catch (\Exception $e) {
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }
    }
}
