<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('dokter.profile.edit');
    }

    public function update(Request $request)
    {
        // implement profile update logic as needed
        return redirect()->route('dokter.dashboard')->with('success', 'Profile updated');
    }
}
