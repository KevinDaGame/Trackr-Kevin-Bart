<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Recipient;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        return view('customers', [
            'customers' => Recipient::with('address') -> filter(request(['name', 'country']))->get(),
            'countries' => Address::select('country')->distinct()->pluck('country')
        ]);
    }

}
