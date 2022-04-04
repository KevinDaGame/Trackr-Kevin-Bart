<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index() {
        if(Auth::user()->level() < 3){
            abort(401);
        }
        return view('customers', [
            'customers' => Recipient::with('address') -> filter(request(['name', 'country']))->get(),
            'countries' => Address::select('country')->distinct()->pluck('country')
        ]);
    }

}
