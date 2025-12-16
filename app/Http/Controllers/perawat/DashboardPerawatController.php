<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPerawatController extends Controller
{
    public function index()
    { 
        return view('perawat.dashboardperawat'); 
    }
}