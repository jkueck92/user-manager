<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
{
    return view('roles.index')
        ->with('roles', Role::all());
}

    public function edit($id)
    {
        return view('roles.edit')
            ->with('role', Role::find($id))
            ->with('permissions', Permission::all());
    }

    public function update(Request $request, Role $role)
    {
        $role->syncPermissions();
        foreach ($request->all() as $key => $value) {
            $permission_value = substr($key, 0, 20);
            if ($permission_value === 'permission_checkbox_') {
                $permission_id = substr($key, 20, strlen($key));
                $permission = Permission::findById($permission_id);
                $role->givePermissionTo($permission);
            }
        }
        return redirect('/roles')->with('success', 'Role updated!');
    }

    public function create()
    {
        return view('roles.create')
            ->with('permissions', Permission::all());
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->get('name')]);
        foreach ($request->all() as $key => $value) {
            $permission_value = substr($key, 0, 20);
            if ($permission_value === 'permission_checkbox_') {
                $permission_id = substr($key, 20, strlen($key));
                $permission = Permission::findById($permission_id);
                $role->givePermissionTo($permission);
            }
        }
        return redirect('/roles')->with('success', 'Role saved!');
    }

}
