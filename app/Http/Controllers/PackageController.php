<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index() {
        return view('packages', [
            'packages' => Package::with(['sender', 'recipient'])->filter()->get()
        ]);
    }
}
