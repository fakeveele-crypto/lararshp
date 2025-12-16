<?php

namespace App\Http\Controllers\Admin;

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
        
        return view('admin.pemilik.indexpemilik', compact('pemilik'));
    }

    public function create()
    {
        return view('admin.pemilik.createpemilik');
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

        // Use provided password (required)
        $rawPassword = $data['password'];

        $email = $data['email'] ?? ('pemilik+' . (isset($data['no_wa']) && $data['no_wa'] ? Str::slug($data['no_wa']) : Str::random(6)) . '@local.test');
        $nama = $data['nama'] ?? 'Pemilik ' . ($data['no_wa'] ?? '');

        // Reuse existing user if email exists
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

        // Ensure 'pemilik' role exists and assign it (avoid duplicate role_user entries)
        $role = Role::firstOrCreate(['nama_role' => 'pemilik']);
        roleUser::firstOrCreate(['iduser' => $user->iduser, 'idrole' => $role->idrole]);

        // prevent duplicate pemilik for same user
        if (Pemilik::where('iduser', $user->iduser)->exists()) {
            return redirect()->back()->withInput()->with('error', 'User sudah terdaftar sebagai Pemilik.');
        }

        // Create Pemilik linked to the user
        $pemilik = Pemilik::create([
            'no_wa' => $data['no_wa'] ?? null,
            'alamat' => $data['alamat'] ?? null,
            'iduser' => $user->iduser,
        ]);

        $redirect = redirect()->route('admin.pemilik.index')->with('success', 'Pemilik disimpan');
        if ($createdNewUser) {
            $redirect = $redirect->with('new_user_credentials', ['email' => $email, 'password' => $rawPassword]);
        } else {
            $redirect = $redirect->with('info', 'Existing user used; password not changed.');
        }
        return $redirect;
    }

    public function edit($idpemilik)
    {
        $item = Pemilik::findOrFail($idpemilik);
        return view('admin.pemilik.editpemilik', compact('item'));
    }

    public function update(Request $request, $idpemilik)
    {
        $item = Pemilik::findOrFail($idpemilik);
        $data = $request->validate(['no_wa'=>'nullable|string','alamat'=>'nullable|string','iduser'=>'nullable|integer']);
        $item->update($data);
        return redirect()->route('admin.pemilik.index')->with('success','Pemilik diperbarui');
    }

    public function destroy($idpemilik)
    {
        $item = Pemilik::findOrFail($idpemilik);
        $item->delete();
        return redirect()->route('admin.pemilik.index')->with('success','Pemilik dihapus');
    }
}