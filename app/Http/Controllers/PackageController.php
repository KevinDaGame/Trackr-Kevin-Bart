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
//        $validated = $request->validate([
//            'sender_id' => 'required|exists:senders,id',
//            'notes' => 'max:255',
//            'recipient.first_name' => 'required|max:255',
//            'recipient.middle_name' => 'max:255',
//            'recipient.last_name' => 'required|max:255',
//            'recipient.address.country' => 'required|max:255',
//            'recipient.address.city' => 'required|max:255',
//            'recipient.address.street' => 'required|max:255',
//            'recipient.address.house_number' => 'required',
//            'recipient.address.addition' => 'max:1',
//            'recipient.address.postal_code' => 'required|max:10',
//        ]);
//        if(count($validated) > 0){
//            return $validated;
//        }
//        $address = Address::where('country', $country)
//            ->where('city', $city)
//            ->where('postal_code', $postal_code)
//            ->where('street', $street)
//            ->where('house_number', $house_number)
//            ->where('addition', $addition);
//        if($address == null){
//            $address = new Address;
//            $address->country = $country;
//            $address->city = $city;
//            $address->postal_code = $postal_code;
//            $address->street = $street;
//            $address->house_number = $house_number;
//            $address->addition = $addition;
//        }
        $country = $request->get('recipient.address.country');
        $city = $request->get('recipient.address.city');
        $postal_code = $request->get('recipient.address.postal_code');
        $street = $request->get('recipient.address.street');
        $house_number = $request->get('recipient.address.house_number');
        $addition = $request->get('recipient.address.addition');
        $address = Address::firstOrCreate(
            [
                'country' => $country,
                'city' => $city,
                'postal_code' => $postal_code,
                'street' => $street,
                'house_number' => $house_number,
                'addition' => $addition,
            ],
            [
                'country' => $country,
                'city' => $city,
                'postal_code' => $postal_code,
                'street' => $street,
                'house_number' => $house_number,
                'addition' => $addition,
            ]
        );
        return $address;
        $newPackage = new Package([
            'sender_id' => $request->get('sender_id'),
            'recipient_id' => $request->get('recipient_id'),
            'notes' => $request->get('notes')
        ]);
        $newPackage->save();
        return json([
            'success'   => false,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
