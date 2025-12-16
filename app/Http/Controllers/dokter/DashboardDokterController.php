<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDokterController extends Controller
{
    public function index()
    {
        return view('dokter.dashboard-dokter'); 
    }
}