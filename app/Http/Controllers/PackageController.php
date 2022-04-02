<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Status;
use App\Http\Requests\ReportPackageRequest;
use App\Models\Address;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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

    public function generatePdf() {
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
