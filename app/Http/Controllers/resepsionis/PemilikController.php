<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\Role;
use App\Models\roleUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('resepsionis.pemilik.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_wa' => 'nullable|string',
            'alamat' => 'nullable|string',
            'iduser' => 'nullable|integer',
            'nama' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'required|string',
        ]);

        $rawPassword = $data['password'];
        $email = $data['email'] ?? ('pemilik+' . (isset($data['no_wa']) && $data['no_wa'] ? Str::slug($data['no_wa']) : Str::random(6)) . '@local.test');
        $nama = $data['nama'] ?? 'Pemilik ' . ($data['no_wa'] ?? '');

        $existingUser = User::where('email', $email)->first();
        $createdNewUser = false;
        if ($existingUser) {
            $user = $existingUser;
            if ($user->nama !== $nama) {
                $user->update(['nama' => $nama]);
            }
        } else {
            $user = User::create([
                'nama' => $nama,
                'email' => $email,
                'password' => Hash::make($rawPassword),
            ]);
            $createdNewUser = true;
        }

        $role = Role::firstOrCreate(['nama_role' => 'pemilik']);
        roleUser::firstOrCreate(['iduser' => $user->iduser, 'idrole' => $role->idrole]);

        if (Pemilik::where('iduser', $user->iduser)->exists()) {
            return redirect()->back()->withInput()->with('error', 'User sudah terdaftar sebagai Pemilik.');
        }

        $pemilik = Pemilik::create([
            'no_wa' => $data['no_wa'] ?? null,
            'alamat' => $data['alamat'] ?? null,
            'iduser' => $user->iduser,
        ]);

        $redirect = redirect()->route('resepsionis.datapemilik.index')->with('success', 'Pemilik disimpan');
        if ($createdNewUser) {
            $redirect = $redirect->with('new_user_credentials', ['email' => $email, 'password' => $rawPassword]);
        } else {
            $redirect = $redirect->with('info', 'Existing user used; password not changed.');
        }
        return $redirect;
    }

    public function edit($id)
    {
        $item = Pemilik::findOrFail($id);
        return view('resepsionis.pemilik.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Pemilik::findOrFail($id);
        $data = $request->validate(['no_wa'=>'nullable|string','alamat'=>'nullable|string']);
        $item->update($data);
        return redirect()->route('resepsionis.datapemilik.index')->with('success','Pemilik diperbarui');
    }

    public function destroy($id)
    {
        $item = Pemilik::findOrFail($id);
        $item->delete();
        return redirect()->route('resepsionis.datapemilik.index')->with('success','Pemilik dihapus');
    }
}
