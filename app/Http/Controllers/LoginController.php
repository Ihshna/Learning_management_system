<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error','Invalid username or password');
        }

        

        // Login the user
        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        elseif($user->role === 'student' && $user->status === 'pending') {
                return redirect('/login')->with('status', 'Account Waiting for admin approval');
            }
        elseif($user->role === 'student' && $user->status === 'approved'){
                return redirect()->route('student.dashboard');
            }
        
            return redirect('/');
        
    }
       
       

         // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

   
