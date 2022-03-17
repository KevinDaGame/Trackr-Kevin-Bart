<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{

    public function index(){
        return view('login.index');
    }
    public function login(Request $request){
        request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        $user = User::whereEmail($request->email)->get()->first();
        if(Hash::check($request->password ,$user->password)) {
            auth()->login($user);
            return redirect('/')->with('success', 'You are logged in!');
        } else {
            dd('Failed!!!');
        }
    }
    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', 'You have successfully logged out!');
    }
}
