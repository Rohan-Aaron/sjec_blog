<?php

namespace App\Http\Controllers;
use GuzzleHttp\Promise\Create;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class PermissionController extends Controller
{
    public function index()
    {   
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $permissions = Permission::all();
        return view('admin.access.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|unique:permissions,name',
        ]);
        Permission::Create([
            'name' => $request->name,
            'guard' => 'web'
        ]);
        toastr()->success( 'Permission created successfully');
        return redirect()->route('permissions.index');

    }

    public function update(Request $request)
    {
        $permission = Permission::find($request->id);
        // dd($permission);  
        $permission->name = $request->name;
        $permission->save();
        toastr('Permission Updated Sucessfully', 'success', );
        return redirect()->route('permissions.index');
    }

    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            toastr()->info('Permission not found');
            return redirect()->route('permissions.index');
        }
        if ($permission->users()->exists()) {
            toastr()->warning('Could not delete the permission already directly linked to users!');
            return redirect()->route('permissions.index');
        }
        if ($permission->roles()->exists()) {
            toastr()->warning('Could not delete the permission already linked to role!');
            return redirect()->route('permissions.index');
        }

        $permission->delete();
        toastr()->success('Permission deleted successfully');
        return redirect()->route('permissions.index');
    }
}
