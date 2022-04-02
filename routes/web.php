<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/packages', [PackageController::class, 'index']);

Route::get('/customers', [CustomerController::class, 'index']);

Route::get('/generate-pdf', [PackageController::class, 'generatePdf']);

Route::get('/generate-pdfs', [PackageController::class, 'generatePdfs']);
