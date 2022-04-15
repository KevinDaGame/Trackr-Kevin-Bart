<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageUser;
use App\Models\Review;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TrackrController extends Controller
{
    public function index()
    {
        if (session()->has(['postal-code', 'trace-code'])) {
            $package = Package::with('recipient.address')->find(session()->get('trace-code'));
            if ($package != null && $package->recipient->address->postal_code == strtoupper(str_replace(' ', '', session()->get('postal-code')))) {
                return view('trackr.index', ['package' => $package]);
            } else {
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

    public function packages()
    {
        $user = Auth::user();
        return view('trackr.packages', ['packages' => $user->packages()->get()]);
    }

    public function savePackage()
    {
        PackageUser::create([
            'user_id' => Auth::user()->id,
            'package_id' => request()->get('package_id')
        ]);
        return redirect('')->with('succes', 'package saved!');
    }

    public function review($id)
    {
        return view('trackr.leaveReview', [
            'package' => Package::find($id)
        ]);
    }

    public function saveReview()
    {
        request()->validate([
            'trace-code' => 'required|exists:packages,id',
            'review' => 'required|min:10'
        ]);
        Review::create(
            [
                'package_id' => request()->get('trace-code'),
                'review' => request()->get('review'),
                'user_id' => Auth::user()->id
            ]
        );
        return redirect('/trackr/packages')->with('succes', 'review saved!');
    }
}
