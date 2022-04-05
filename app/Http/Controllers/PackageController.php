<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Recipient;
use App\Models\Sender;
use App\Models\Status;
use App\Http\Requests\ReportPackageRequest;
use App\Models\Address;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Jorgenwdm\Barcode\Generators\Barcode1d;
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

    public function create() {
        return view('webshop.signupPackage');
    }

    public function store() {
        request()->validate([
            'recipient-name' => 'required|max:255|min:3',
            'recipient-street' => 'required|max:255',
            'recipient-house_number' => 'required|numeric',
            'recipient-addition' => 'max:2',
            'recipient-postal_code' => 'required|max:255',
            'recipient-city' => 'required|max:255',
            'recipient-country' => 'required|max:255',
            'recipient-phone_number' => 'required|max:16',
            'recipient-email'=> 'required|email|max:255',
            'notes' => 'max:65535'
        ]);

        $recipientAddress = Address::firstOrCreate([
            'country' => request()->get('recipient-country'),
            'street' => request()->get('recipient-street'),
            'city' => request()->get('recipient-city'),
            'postal_code' => request()->get('recipient-postal_code'),
            'house_number' => request()->get('recipient-house_number'),
            'addition' => request()->get('recipient-addition')
        ]);

        $recipient = Recipient::firstOrCreate([
            'name' => request()->get('recipient-name'),
            'email_address' => request()->get('recipient-email'),
            'phone_number' => request()->get('recipient-phone_number'),
            'address_id' => $recipientAddress->id
        ]);

        $package = Package::create([
            'sender_id' => Auth::user()->sender_id,
            'recipient_id' => $recipient->id,
            'notes' => request()->get('notes'),
            'status_id' => '1'
        ]);

        return view('webshop.packageSignupSuccess', [
            'packageIds' => [$recipient->email_address => $package->id]
        ]);
    }

    public function storeCsv() {
        $path = request()->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        //remove the header from the file
        unset($data[0]);
        $packages = [];

        foreach ($data as $row) {
            $recipientAddress = Address::firstOrCreate([
                'country' => $row[3],
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

        return view('webshop.packageSignupSuccess', [
            'packageIds' => $packages
        ]);
    }

    public function generatePdf() {
        if(Auth::user()->level() < 3){
            abort(401);
        }
        $package = Package::With('sender', 'recipient')->find(request('id'));
        $barcode = Barcode1d::create("C128", Str::limit($package->id, 16, ""))->toHtml();

        $data = [
            'date' => date('d/m/y'),
            'package' => $package,
            'barcode' => $barcode
        ];

        $pdf = Pdf::loadView('myPDF', $data);

        return $pdf->stream('label.pdf');
    }

    public function generatePdfs(Request $request) {
        if(Auth::user()->level() < 3){
            abort(401);
        }
        $packageIds = $request->query();
        $data = [
            'date' => date('d/m/y'),
            'packages' => [],
            'barcodes' => []
        ];

        foreach ($packageIds as $id) {
            $data['packages'][$id] = Package::with('sender', 'recipient')->find($id);
            $data['barcodes'][$id] = Barcode1d::create("C128", Str::limit($id, 16, ""))->toHtml();
        }

        $pdf = Pdf::loadView('myBigPDF', $data);
        return $pdf->stream('labels.pdf');
    }

    public function requestPickupView() {
        return view('pickup', [
            'packages' => Package::with(['sender', 'recipient'])->where('status_id', '=', '1')->where('transporter', '=', null)->get()
        ]);
    }

    public function requestPickup() {
        date_default_timezone_set("Europe/Amsterdam");
        if (date('H') > 15) {
            request()->validate([
                'time' => 'date|after:tomorrow'
            ]);
        } else {
            request()->validate([
                'time' => 'date|after:+2 Days'
            ]);
        }

        foreach (request()->get('package') as $id) {
            $package = Package::find($id);
            $package->transporter = request()->get('transporter');
            $package->pickup_date = request()->get('time');
            $package->save();
        }

        return redirect('/')->with('succes', 'Pickup moment successfully registered');
    }
}
