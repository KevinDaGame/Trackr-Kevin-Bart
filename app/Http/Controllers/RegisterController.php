<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        request()->validate([
            'first-name' => 'required|max:255|min:3',
            'last-name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8',
            'phone-number' => 'required|max:255',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'postal_code' => 'required|max:255',
            'house_number' => 'required|numeric|max:255',
            'addition' => 'max:2',

        ]);

        $address = Address::create([
            'country' => request()->get('country'),
            'street' => request()->get('street'),
            'city' => request()->get('city'),
            'postal_code' => request()->get('postal_code'),
            'house_number' => request()->get('house_number'),
            'addition' => request()->get('addition'),
        ]);

        $user = User::create([
            'name' => request()->get('first-name') . ' ' . request()->get('last-name'),
            'email' => request()->get('email'),
            'phone_number' => request()->get('phone-number'),
            'password' => bcrypt(request()->get('password')),
            'address_id' => $address->id,
        ]);
        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created');
    }
}
