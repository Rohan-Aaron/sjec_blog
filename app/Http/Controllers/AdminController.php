<?php

namespace App\Http\Controllers;

use Exception;
use  App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::select('id','name','email','status')->get();
        return view('admin.access.admins.index', compact('users'));
    }

    public function create() {
        return view('admin.access.admins.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required ',
            'email' =>'required|email|unique:users,email',
            'password' => 'required | min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' =>bcrypt($request->password)
        ]);

        toastr()->success('New Admin Account created');
        return redirect()->route('admins.index');
    }
    public function updateStatus(Request $request,$id)
    {
        // dd($request->all(),$id);
       try{
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'Updated Successfully');
       }catch(Exception $e){
        // dd($e);
        toastr()->error($e);
        return back();
       }
    }

    

}
