<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        return view('permissions.index')
            ->with('permissions', Permission::all());
    }

    public function edit($id)
    {
        return view('permissions.edit')
            ->with('permission', Permission::find($id));
    }

    public function update(Request $request, Role $role)
    {

    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        Permission::create(['name' => $request->get('name')]);
        return redirect('/permissions')->with('success', 'Permission saved!');
    }

}
