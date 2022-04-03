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
            'sender-name' => 'required|max:255|min:3',
            'sender-street' => 'required|max:255',
            'sender-house_number' => 'required|numeric',
            'sender-addition' => 'max:2',
            'sender-postal_code' => 'required|max:255',
            'sender-city' => 'required|max:255',
            'sender-country' => 'required|max:255',
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

        $senderAddress = Address::firstOrCreate([
            'country' => request()->get('sender-country'),
            'street' => request()->get('sender-street'),
            'city' => request()->get('sender-city'),
            'postal_code' => request()->get('sender-postal_code'),
            'house_number' => request()->get('sender-house_number'),
            'addition' => request()->get('sender-addition')
        ]);

        $sender = Sender::firstOrCreate([
           'name' => request()->get('sender-name'),
           'address_id' => $senderAddress->id
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
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'notes' => request()->get('notes'),
            'status' => 'Reported'
        ]);

        return redirect('/')->with('success', 'Your package has been registered');
    }

    public function generatePdf() {
        if(Auth::user()->level() < 3){
            abort(401);
        }
        $package = Package::With('sender', 'recipient')->find(request('id'));
        $barcode = Barcode1d::create("C128", Str::limit($package->id, 16, ""))->toHtml();

        $data = [
            'title' => 'Dit is een label',
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
            'title' => 'Dit is een label',
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
}
