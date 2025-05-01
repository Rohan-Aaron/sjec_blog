<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function index()
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $roles = Role::all();
        return view('admin.access.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|unique:permissions,name',
        ]);
        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        toastr()->success('Role created');
        return redirect()->route('roles.index');
    }

    public function update(Request $request)
    {
        $role = Role::find($request->id);
        if ($role->name == 'Super Admin') {
            toastr()->warning('Super Admin Role Updating restricted!');
            return redirect()->back();
        }
        $role->name = $request->name;
        $role->save();
        toastr()->success('Updated successfully');
        return redirect()->route('roles.index');
    }
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if ($role->name == 'Super Admin') {
            toastr()->warning('Super Admin Role deleting restricted!');
            return redirect()->back();
        }
        if ($role->users()->exists()) {
            toastr()->warning('Could not delete the role already linked to users!');
            return redirect()->back();
        }
        $role->syncPermissions();
        $role->delete();
        toastr()->success('Role deleted successfully');
        return redirect()->back();
    }

    public function assignPermissions(Request $request, $id)
    {
        $role = Role::find($id);
        $rolePermissions = $role->getAllPermissions()->pluck('name');
        $permissions = Permission::all();
        $users = $role ? $role->users()->get() : collect();
        return view('admin.access.permissions.assign', compact('role', 'users', 'permissions', 'rolePermissions'));
    }

    public function assignPermissionsToRole(Request $request, $id)
    {
        // dd($request->all());
        $role = Role::find($id);
        $permissions = $request->input('permissions', []);
        if ($role) {
            $role->syncPermissions($permissions);
            toastr()->success('Permissions assigned successfully');
        } else {
            toastr()->error('Role not found');
        }
        return redirect()->back();
    }

    public function fetchUsers()
    {
        $users = User::select('id', 'name', 'email')->get();
        return response()->json($users);
    }

    public function assignUser(Request $request, $id)
    {

        $role = Role::find($id);
        $user = User::find($request->id);
        if ($user->roles()->exists())
            toastr()->warning('User is already assigned a role');
        else
            $user->assignRole($role);
        toastr()->success('Role assigned successfuly');
        // dd($role->name,$user->name);
        // toastr()->warning('something went wrong');
        return redirect()->back();
    }

    public function revokeUser(Request $request, $id)
    {
        $role = Role::find($id);
        $user = User::find($request->id);
        if ($user->hasRole($role->name)) {
            $user->removeRole($role->name);
            toastr()->success('Role revoked sucessfully');
        } else {
            toastr()->warning('Something went wrong');
        }
        return redirect()->back();
    }
}
