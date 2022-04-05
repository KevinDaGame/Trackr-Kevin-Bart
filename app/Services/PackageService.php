<?php namespace App\Services;
use App\Models\Address;
use App\Models\Package;
use App\Models\Recipient;
use Illuminate\Support\Facades\Auth;

class PackageService {

    public static function CreatePackage($data) {
        $recipientAddress = Address::firstOrCreate([
            'country' => $data['recipient-country'],
            'street' => $data['recipient-street'],
            'city' => $data['recipient-city'],
            'postal_code' => $data['recipient-postal_code'],
            'house_number' => $data['recipient-house_number'],
            'addition' => $data['recipient-addition']
        ]);

        $recipient = Recipient::firstOrCreate([
            'name' => $data['recipient-name'],
            'email_address' => $data['recipient-email'],
            'phone_number' => $data['recipient-phone_number'],
            'address_id' => $recipientAddress->id
        ]);

        $package = Package::create([
            'sender_id' => Auth::user()->sender_id,
            'recipient_id' => $recipient->id,
            'notes' => $data['notes'],
            'status_id' => '1'
        ]);
        return $package->id;
    }

    public static function CreatePackages($data){
        $packages = [];

        foreach ($data as $row) {
            $recipientAddress = Address::firstOrCreate([
                'country' => $row[5],
                'street' => $row[5],
                'city' => $row[4],
                'postal_code' => $row[8],
                'house_number' => $row[6],
                'addition' => $row[7] == "" ? null : $row[7]
            ]);

            $recipient = Recipient::firstOrCreate([
                'name' => $row[0],
                'email_address' => $row[1],
                'phone_number' => $row[2],
                'address_id' => $recipientAddress->id
            ]);

            $package = Package::create([
                'sender_id' => Auth::user()->sender_id,
                'recipient_id' => $recipient->id,
                'notes' => request()->get('notes'),
                'status_id' => '1'
            ]);

            $packages[$row[1]] = $package->id;
        }

        return $packages;
    }
}
