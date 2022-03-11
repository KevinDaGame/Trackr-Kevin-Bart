<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
                return view('customers', [
            'customers' => Recipient::with('address') -> filter()->get()
        ]);
    }

}
