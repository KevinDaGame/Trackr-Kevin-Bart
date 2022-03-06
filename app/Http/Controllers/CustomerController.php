<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = Recipient::with('address');

        if (request('search')) {
            $customers
                ->where('first_name' ,'like', '%' . request('search') . '%')
                ->orWhere('middle_name', 'like', '%' . request('search') . '%')
                ->orWhere('last_name', 'like', '%' . request('search') . '%');
        }

        return view('customers', [
            'customers' => $customers->get()
        ]);
    }

}
