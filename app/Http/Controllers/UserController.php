<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        return view('users.index')
            ->with('users', User::all());
    }

    public function edit($id)
    {
        return view('users.edit')
            ->with('user', User::find($id))
            ->with('roles', Role::all());
    }

    public function update(Request $request, User $user)
    {
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->save();

        $user->syncRoles();
        foreach ($request->all() as $key => $value) {
            $role_value = substr($key, 0, 14);
            if ($role_value === 'role_checkbox_') {
                $role_id = substr($key, 14, strlen($key));
                $role = Role::findById($role_id);
                $user->assignRole($role);
            }
        }
        return redirect('/users')->with('success', 'User updated!');
    }

    public function create()
    {
        return view('users.create')
            ->with('roles', Role::all());
    }

    public function store(Request $request)
    {
        $user = new User([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => Hash::make('secret')
        ]);
        $user->save();

        foreach ($request->all() as $key => $value) {
            $role_value = substr($key, 0, 14);
            if ($role_value === 'role_checkbox_') {
                $role_id = substr($key, 14, strlen($key));
                $role = Role::findById($role_id);
                $user->assignRole($role);
            }
        }
        return redirect('/users')->with('success', 'User saved!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }

}
