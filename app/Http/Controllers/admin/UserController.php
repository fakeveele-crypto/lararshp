<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\roleUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roleUsers.role', 'pemilik')->get(); 
        
        return view('admin.user.indexuser', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.createuser', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6',
            'idrole' => 'required|exists:role,idrole',
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        // assign role
        roleUser::create([
            'iduser' => $user->iduser,
            'idrole' => $data['idrole'],
        ]);
        return redirect()->route('admin.user.index')->with('success','User dibuat');
    }

    public function edit($iduser)
    {
        $user = User::with('roleUsers')->findOrFail($iduser);
        $roles = Role::all();
        return view('admin.user.edituser', compact('user','roles'));
    }

    public function update(Request $request, $iduser)
    {
        $user = User::findOrFail($iduser);
        $data = $request->validate(['nama'=>'required|string','email'=>'required|email','idrole'=>'required|exists:role,idrole']);
        $user->update($data);
        // update role assignment: remove old and add new
        roleUser::where('iduser', $user->iduser)->delete();
        roleUser::create([
            'iduser' => $user->iduser,
            'idrole' => $data['idrole'],
        ]);
        return redirect()->route('admin.user.index')->with('success','User diperbarui');
    }

    public function destroy($iduser)
    {
        $user = User::findOrFail($iduser);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success','User dihapus');
    }
}