<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function generatePDF($id)
    {
        $package = Package::With('sender', 'receiver')->find($id);

        $data = [
            'package' => $package
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('test.pdf');
    }
}
