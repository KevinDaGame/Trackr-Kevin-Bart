<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Status;
use App\Http\Requests\ReportPackageRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index() {
        if(Auth::user()->level() < 3){
            abort(401);
        }
        return view('packages', [
            'packages' => Package::with(['sender', 'recipient'])->filter(request(['sender', 'receiver', 'status']))->get(),
            'statuses' => Status::pluck('status')
        ]);
    }
}
