<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'),$request->get('remember'))) {
            // Redirect to the intended page or home
            toastr('Welcome '. auth()->user()->name, 'success');
            return redirect()->intended('/management');
        }

        // If authentication fails, redirect back with an error message
        toastr('Invalid credentials', 'error');
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        toastr('Logout successfully', 'success');
        return redirect('/login');
    }
}
