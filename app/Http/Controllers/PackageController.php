<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index() {
        $packages = Package::with(['sender', 'recipient']);

        if (request('search')) {
            $packages
                ->whereHas( 'sender', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('recipient', function ($r) {
                    $r->where('first_name' ,'like', '%' . request('search') . '%')
                        ->orWhere('middle_name', 'like', '%' . request('search') . '%')
                        ->orWhere('last_name', 'like', '%' . request('search') . '%');
                });
        }

        return view('packages', [
            'packages' => $packages->get()
        ]);
    }
}
