<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportPackageRequest;
use App\Http\Requests\UpdatePackageRequest;
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

    public function update(UpdatePackageRequest $request)
    {
        $package = Package::find($request->id);
        $webshop = Sender::find(Auth::user()->sender_id);
        if ($package->sender_id == $webshop->id) {
            $package->status_id = $this->getNewPackageStatus($request->status_id, $package->status);
            $package->save();
        }
        return json_encode([
            'success' => true,
            'message' => 'Successfully updated the status of this package',
            'package' => $package->id,
            'status' => $package->status->status
        ]);
    }

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
            'status_id' => '1'
        ]);

        $newPackage->save();
        return json_encode([
            'success' => true,
            'message' => 'Successfully registered package',
            'id' => $newPackage->id,
            'created_at' => $newPackage->created_at
        ]);
    }

    public function getNewPackageStatus(int $id, int $packageStatusId): int
    {
        if ($id > 0) {
            return $id;
        } else if ($packageStatusId <= 6) {
            return $packageStatusId + 1;
        }
        return $packageStatusId;
    }
}
