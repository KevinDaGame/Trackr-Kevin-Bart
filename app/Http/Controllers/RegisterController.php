<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        request()->validate([
            'first-name' => 'required|max:255|min:2',
            'last-name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'postal_code' => 'required|postal_code:NL,DE,FR,BE,LU',
            'house_number' => 'required|numeric',
            'addition' => 'max:2',
        ]);

        $address = Address::firstOrCreate([
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
            'password' => bcrypt(request()->get('password')),
            'address_id' => $address->id,
        ]);
        $user->attachRole(config('roles.models.role')::where('name', '=', 'Customer')->first());
        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created!');
    }

    public function addEmployeeView() {
        return view('register.addEmployee', [
            'roles' => Role::pluck('name')
        ]);
    }

    public function addEmployee() {
        request()->validate([
            'first-name' => 'required|max:255|min:3',
            'last-name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8',
        ]);

        $user = User::create([
            'name' => request()->get('first-name') . ' ' . request()->get('last-name'),
            'email' => request()->get('email'),
            'password' => bcrypt(request()->get('password')),
        ]);
        $user->attachRole(config('roles.models.role')::where('name', '=', request()->get('role'))->first());

        return redirect('/')->with('succes', 'A new employee has been created');
    }

    public function addWebshopView() {
        return view('register.addWebshop');
    }

    public function addWebshop() {
        request()->validate([
            'first-name' => 'required|max:255|min:2',
            'last-name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8',
            'company-name' => 'required|max:255|min:3',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'postal_code' => 'required|postal_code:NL,DE,FR,BE,LU',
            'house_number' => 'required|numeric',
            'addition' => 'max:2',
        ]);

        $address = Address::firstOrCreate([
            'country' => request()->get('country'),
            'street' => request()->get('street'),
            'city' => request()->get('city'),
            'postal_code' => request()->get('postal_code'),
            'house_number' => request()->get('house_number'),
            'addition' => request()->get('addition')
        ]);

        $sender = Sender::firstOrCreate([
            'name' => request()->get('company-name'),
            'address_id' => $address->id
        ]);

        $user = User::create([
            'name' => request()->get('first-name') . ' ' . request()->get('last-name'),
            'email' => request()->get('email'),
            'password' => bcrypt(request()->get('password')),
            'sender_id' => $sender->id
        ]);
        $user->attachRole(config('roles.models.role')::where('name', '=', 'Web shop')->first());

        return redirect('/')->with('succes', 'A new webshop has been added');
    }
}
