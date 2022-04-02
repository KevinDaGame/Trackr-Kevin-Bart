<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RegisterController;
use App\Models\Package;
use App\Models\Recipient;
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
Route::get('/roletest', function () {
    return view('roletest');
});
Route::get('/packages', [PackageController::class, 'index']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [AuthenticationController::class, 'index'])->middleware('guest');
Route::post('login', [AuthenticationController::class, 'login'])->middleware('guest');
Route::get('logout', [AuthenticationController::class, 'logout'])->middleware('auth');

Route::get('/generate-pdf', [PackageController::class, 'generatePdf']);

Route::get('/generate-pdfs', [PackageController::class, 'generatePdfs']);
