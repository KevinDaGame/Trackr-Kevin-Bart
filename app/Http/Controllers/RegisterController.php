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
            'first-name' => 'required|max:255|min:3',
            'middle-name' => 'max:255',
            'last-name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255|min:8',
            'phone-number' => 'required|max:255',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'postal_code' => 'required|max:255',
            'house_number' => 'required|numeric|max:255',
            'addition' => 'max:2',
            'account-type' => 'required',

        ]);

        $address = Address::firstOrCreate([
            'country' => request()->get('country'),
            'street' => request()->get('street'),
            'city' => request()->get('city'),
            'postal_code' => request()->get('postal_code'),
            'house_number' => request()->get('house_number'),
            'addition' => request()->get('addition'),
        ]);


        return request()->all();
    }
}
