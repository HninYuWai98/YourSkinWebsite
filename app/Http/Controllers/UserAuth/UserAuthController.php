<?php

namespace App\Http\Controllers\UserAuth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function authLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin-dashboard')->withSuccess('Login Successfully.');
        }
        
        return back()->with('error', 'Please fill correct Email and Password');
    }
}
