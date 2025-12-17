<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;

class DashboardDokterController extends Controller
{
    public function index()
    {
        // Render the dokter dashboard view. Use the view name that exists in resources/views/dokter/
        return view('dokter.dashboarddokter');
    }
}