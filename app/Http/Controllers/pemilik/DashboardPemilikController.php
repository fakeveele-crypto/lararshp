<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPemilikController extends Controller 
{
    public function index()
    {
        return view('pemilik.dashboard-pemilik'); 
    }
}