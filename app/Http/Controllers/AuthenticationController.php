<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{

    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $attributes = request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        if (auth()->attempt($attributes)) {

            return redirect('/')->with('success', 'You are logged in!');
        } else {
            return back()->withErrors([
                'email' => 'Your credentials could not be verified'
            ])->withInput();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You have successfully logged out!');
    }
}
