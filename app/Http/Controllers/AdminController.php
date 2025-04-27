<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users=User::all();
        return view('admin.access.admins.index',compact('users'));
    }
}
