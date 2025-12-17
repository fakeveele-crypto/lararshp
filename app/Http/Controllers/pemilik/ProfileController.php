<?php
namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('pemilik.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200',
        ]);

        $user = auth()->user();
        $user->nama = $data['nama'];
        $user->email = $data['email'];
        $user->save();

        return redirect()->route('pemilik.profile.edit')->with('success','Profile diperbarui');
    }
}
