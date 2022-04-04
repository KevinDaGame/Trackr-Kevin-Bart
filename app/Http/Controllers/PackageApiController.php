<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportPackageRequest;
use App\Models\Address;
use App\Models\Package;
use App\Models\Recipient;
use App\Models\Sender;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PackageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * @return false|string
     */
    public function store(ReportPackageRequest $request)
    {
        $recipientData = $request->get('recipient');
        $recipientAddressData = $recipientData['address'];
        $recipientAddition = $recipientAddressData['addition'] ?? null;

        $recipientAddress = Address::firstOrCreate([
            'country' => $recipientAddressData['country'],
            'street' => $recipientAddressData['street'],
            'city' => $recipientAddressData['city'],
            'postal_code' => $recipientAddressData['postal_code'],
            'house_number' => $recipientAddressData['house_number'],
            'addition' => $recipientAddition
        ]);

        $recipient = Recipient::firstOrCreate([
            'name' => $recipientData['name'],
            'email_address' => $recipientData['email'],
            'phone_number' => $recipientData['phone'],
            'address_id' => $recipientAddress->id
        ]);

        $newPackage = new Package([
            'sender_id' => Auth::user()->sender_id,
            'recipient_id' => $recipient->id,
            'notes' => $request->get('notes'),
            'status' => 'Reported'
        ]);

        $newPackage->save();
        return json_encode([
                'success'   => true,
                'message'   => 'Succesfully registered package',
                'data'      => [
                    'id' => $newPackage->id,
                    'created_at' => $newPackage->created_at]
        ]);
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
