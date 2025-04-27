<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $roles=Role::all();
        return view('admin.access.roles.index',compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=> 'required|string|min:2|unique:permissions,name',
        ]);
        Role::create([
            'name' => $request->name,
            'guard_name'=>'web',
        ]);
        toastr()->success('Role created');
        return redirect()->route('roles.index');
    }

    public function update(Request $request){
        $role=Role::find($request->id);
        if ($role->name == 'Super Admin') {
            toastr()->warning('Super Admin Role Updating restricted!');
            return redirect()->back();
        }
        $role->name=$request->name;
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
}
