<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportPackageRequest;
use App\Models\Address;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return response()->json($packages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportPackageRequest $request)
    {
        $recipient = $request->get('recipient');
        $address = $recipient['address'];
        $addition = $address['addition'] ?? null;

        $address = Address::firstOrCreate(
            [
                'country' => $address['country'],
                'city' => $address['city'],
                'postal_code' => $address['postal_code'],
                'street' => $address['street'],
                'house_number' => $address['house_number'],
                'addition' => $addition,
            ]
        );
        $newPackage = new Package([
            'sender_id' => $request->get('sender_id'),
            'address_id' => $address->id,
            'notes' => $request->get('notes'),
            'status' => 'Reported'
        ]);
        $newPackage->save();
        return json_encode([
            'success'   => true,
            'message'   => 'Succesfully registered package',
            'data'      => $newPackage]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        return null;
    }
}
