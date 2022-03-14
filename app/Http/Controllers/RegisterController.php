<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
        request() -> validate([
            'first-name' => 'required',
            'middle-name' => 'required',
            'last-name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone-number' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'postal_code' => 'required',
            'house_number' => 'required',
            'addition' => 'required',
            'account-type' => 'required',

        ]);

        return request()->all();
    }
}
