<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TrackrController extends Controller
{
    public function index()
    {
        if (session()->has(['postal-code', 'trace-code'])) {
            $package = Package::with('recipient.address')->find(session()->get('trace-code'));
            if ($package->recipient->address->postal_code == strtoupper(str_replace(' ', '', session()->get('postal-code')))) {
                return view('trackr.index', ['package' => $package]);
            }
            else{
                session()->remove('postal-code');
                session()->remove('trace-code');
            }

        }
        return view('trackr.index');
    }

    public function findPackage()
    {
        request()->validate([
            'trace-code' => 'required|exists:packages,id',
            'postal-code' => 'required'
        ]);
        $package = Package::with('recipient.address')->find(request()->get('trace-code'));
        if ($package->recipient->address->postal_code == strtoupper(str_replace(' ', '', request()->get('postal-code')))) {
            session()->put('trace-code', $package->id);
            session()->put('postal-code', $package->recipient->address->postal_code);
            return redirect('');
        }
        return back()->withErrors([
            'postal-code' => 'This postal code did not match'
        ])->withInput();
    }

    public function showPackage()
    {
        return view('trackr.package');
    }
}
