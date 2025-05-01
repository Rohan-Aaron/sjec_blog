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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            toastr()->error('No account found with this email');
            return back()->withInput()->withErrors([
                'email' => 'No account found with this email.',
            ]);
        }

        if ($user->status != 1) { 
            toastr()->warning('Your account has been blocked, Contact Admin');
            return back()->withInput()->withErrors([
                'email' => 'Your account has been blocked.',
            ]);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->get('remember'))) {
            toastr('Welcome ' . auth()->user()->name, 'success');
            return redirect()->intended('/management');
        }

        // If credentials are invalid
        toastr()->error('Invalid credentials');
        return back()->withInput()->withErrors([
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
