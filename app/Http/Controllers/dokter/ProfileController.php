<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dokter.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'password' => ['nullable','string','min:6','confirmed'],
        ]);

        $user->nama = $data['nama'];
        $user->email = $data['email'];
        if(!empty($data['password'])){
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return redirect()->route('dokter.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
