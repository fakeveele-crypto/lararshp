<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        
        return view('admin.role.indexrole', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.createrole');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama_role' => 'required|string']);
        Role::create($data);
        return redirect()->route('admin.role.index')->with('success','Role ditambahkan');
    }

    public function edit($idrole)
    {
        $item = Role::findOrFail($idrole);
        return view('admin.role.editrole', compact('item'));
    }

    public function update(Request $request, $idrole)
    {
        $item = Role::findOrFail($idrole);
        $data = $request->validate(['nama_role'=>'required|string']);
        $item->update($data);
        return redirect()->route('admin.role.index')->with('success','Role diperbarui');
    }

    public function destroy($idrole)
    {
        $item = Role::findOrFail($idrole);
        $item->delete();
        return redirect()->route('admin.role.index')->with('success','Role dihapus');
    }
}