<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        // gather simple stats for resepsionis dashboard
        $stats = [
            'pemiliks' => Pemilik::count(),
            'pets' => Pet::count(),
            'appointments_total' => TemuDokter::count(),
            'appointments_today' => TemuDokter::whereDate('tanggal', now()->toDateString())->count(),
        ];

        $upcoming = TemuDokter::with(['pet','dokter.user'])->whereDate('tanggal', '>=', now()->toDateString())->orderBy('tanggal')->limit(8)->get();

        return view('resepsionis.dashboardresepsionis', compact('stats','upcoming'));
    }
}