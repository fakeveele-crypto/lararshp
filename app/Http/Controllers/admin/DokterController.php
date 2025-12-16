<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Role;
use App\Models\roleUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')->get();
        return view('admin.datadokter.indexdatadokter', compact('dokters'));
    }

    public function create()
    {
        return view('admin.datadokter.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'bidang_dokter' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'id_user' => 'nullable|integer',
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Determine user fields (use provided values if present)
        $rawPassword = $data['password'] ?? Str::random(8);
        $email = $data['email'] ?? ('dokter+' . (isset($data['bidang_dokter']) && $data['bidang_dokter'] ? Str::slug($data['bidang_dokter']) : Str::random(6)) . '@local.test');
        $namaUser = $data['nama'] ?? ('Dokter ' . ($data['bidang_dokter'] ?? ''));

        // Reuse existing user if email exists
        $existingUser = User::where('email', $email)->first();
        $createdNewUser = false;
        if ($existingUser) {
            $user = $existingUser;
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

        // ensure role 'dokter' exists and assign (avoid duplicate role_user entries)
        $role = Role::firstOrCreate(['nama_role' => 'dokter']);
        roleUser::firstOrCreate(['iduser' => $user->iduser, 'idrole' => $role->idrole]);

        // prevent creating duplicate dokter row for same user
        if (Dokter::where('id_user', $user->iduser)->exists()) {
            return Redirect::back()->withInput()->with('error', 'User sudah terdaftar sebagai Dokter.');
        }

        // attach created user id to dokter data
        $data['id_user'] = $user->iduser;

        Dokter::create($data);
        $redirect = Redirect::route('admin.datadokter.index')->with('success', 'Dokter berhasil ditambahkan');
        if ($createdNewUser) {
            $redirect = $redirect->with('new_user_credentials', ['email' => $email, 'password' => $rawPassword]);
        } else {
            $redirect = $redirect->with('info', 'Existing user used; password not changed.');
        }
        return $redirect;
    }

    public function edit($iddokter)
    {
        $dokter = Dokter::findOrFail($iddokter);
        return view('admin.datadokter.edit', compact('dokter'));
    }

    public function update(Request $request, $iddokter)
    {
        $dokter = Dokter::findOrFail($iddokter);
        $data = $request->validate([
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'bidang_dokter' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'id_user' => 'nullable|integer',
        ]);
        $dokter->update($data);
        return Redirect::route('admin.datadokter.index')->with('success', 'Data dokter diperbarui');
    }

    public function destroy($iddokter)
    {
        $dokter = Dokter::findOrFail($iddokter);
        $dokter->delete();
        return Redirect::route('admin.datadokter.index')->with('success', 'Dokter dihapus');
    }
}
