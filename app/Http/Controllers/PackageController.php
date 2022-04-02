<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Status;
use App\Http\Requests\ReportPackageRequest;
use App\Models\Address;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Jorgenwdm\Barcode\Generators\Barcode1d;

class PackageController extends Controller
{
    public function index() {
        return view('packages', [
            'packages' => Package::with(['sender', 'recipient'])->filter(request(['sender', 'receiver', 'status']))->get(),
            'statuses' => Status::pluck('status')
        ]);
    }

    public function generatePdf() {
        $package = Package::With('sender', 'recipient')->find(request('id'));
        $barcode = Barcode1d::create("C128", $package->id)->toHtml();

        $data = [
            'title' => 'Dit is een label',
            'date' => date('d/m/y'),
            'package' => $package,
            'barcode' => $barcode
        ];

        $pdf = Pdf::loadView('myPDF', $data);

        return $pdf->stream('test.pdf');
    }

    public function generatePdfs(Request $request) {
        dd($request);
    }
}
