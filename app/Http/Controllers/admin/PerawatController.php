<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Role;
use App\Models\roleUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = Perawat::with('user')->get();
        return view('admin.dataperawat.indexdataperawat', compact('perawats'));
    }

    public function create()
    {
        return view('admin.dataperawat.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'nullable|integer',
            'pendidikan' => 'required|string',
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Determine user fields (use provided values)
        $rawPassword = $data['password'];
        $email = $data['email'];
        $namaUser = $data['nama'];

        // If a user with this email already exists, reuse it; otherwise create
        $existingUser = User::where('email', $email)->first();
        $createdNewUser = false;
        if ($existingUser) {
            $user = $existingUser;
            // update name if different
            if ($user->nama !== $namaUser) {
                $user->update(['nama' => $namaUser]);
            }
        } else {
            $user = User::create([
                'nama' => $namaUser,
                'email' => $email,
                'password' => Hash::make($rawPassword),
            ]);
            $createdNewUser = true;
        }

        // ensure role 'perawat' exists and assign (avoid duplicate role_user entries)
        $role = Role::firstOrCreate(['nama_role' => 'perawat']);
        roleUser::firstOrCreate(['iduser' => $user->iduser, 'idrole' => $role->idrole]);

        // prevent creating duplicate perawat row for same user
        if (Perawat::where('id_user', $user->iduser)->exists()) {
            return Redirect::back()->withInput()->with('error', 'User sudah terdaftar sebagai Perawat.');
        }

        // prepare perawat data and create (perawat table does not store name)
        $perawatData = [
            'id_user' => $user->iduser,
            'pendidikan' => $data['pendidikan'] ?? null,
        ];

        Perawat::create($perawatData);

        $redirect = Redirect::route('admin.dataperawat.index')->with('success', 'Perawat berhasil ditambahkan');
        if ($createdNewUser) {
            $redirect = $redirect->with('new_user_credentials', ['email' => $email, 'password' => $rawPassword]);
        } else {
            $redirect = $redirect->with('info', 'Existing user used; password not changed.');
        }
        return $redirect;
    }

    public function edit($idperawat)
    {
        $perawat = Perawat::findOrFail($idperawat);
        return view('admin.dataperawat.edit', compact('perawat'));
    }

    public function update(Request $request, $idperawat)
    {
        $perawat = Perawat::findOrFail($idperawat);
        $data = $request->validate([
            'id_user' => 'nullable|integer',
            'nama' => 'required|string',
            'pendidikan' => 'nullable|string',
        ]);

        // update perawat record (only pendidikan is stored on perawat)
        $perawat->update([
            'pendidikan' => $data['pendidikan'] ?? null,
        ]);

        // also update linked user's name if exists
        if ($perawat->user) {
            $perawat->user->update(['nama' => $data['nama']]);
        }
        return Redirect::route('admin.dataperawat.index')->with('success', 'Data perawat diperbarui');
    }

    public function destroy($idperawat)
    {
        $perawat = Perawat::findOrFail($idperawat);
        $perawat->delete();
        return Redirect::route('admin.dataperawat.index')->with('success', 'Perawat dihapus');
    }
}
