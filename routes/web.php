<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TokensController;
use App\Http\Controllers\TrackrController;
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
    if(Auth::check()) {
        if (Auth()->user()->level() == 1) {
            return redirect('findpackage');
        }
        if (Auth()->user()->level() == 2) {
            return redirect('addpackage');
        }
        if (Auth()->user()->level() >= 3) {
            return redirect('packages');
        }
    }
    return redirect('findpackage');
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

Route::get('/generate-pdf', [PackageController::class, 'generatePdf'])->middleware(['level:3']);

Route::get('/generate-pdfs', [PackageController::class, 'generatePdfs'])->middleware(['level:3']);

Route::get('/webshop/tokens', [TokensController::class, 'index']);
Route::post('deleteToken', [TokensController::class, 'delete']);
Route::post('createToken', [TokensController::class, 'create']);

Route::get('addpackage', [PackageController::class, 'create'])->middleware('role:webshop');
Route::post('addpackage', [PackageController::class, 'store'])->middleware('role:webshop');
Route::post('importcsv', [PackageController::class, 'storeCsv'])->middleware('role:webshop');

Route::get('/findpackage', [TrackrController::class, 'index']);
Route::post('/findPackage', [TrackrController::class, 'findPackage']);


Route::get('addemployee', [RegisterController::class, 'addEmployeeView'])->middleware('level:4');
Route::post('addemployee', [RegisterController::class, 'addEmployee'])->middleware('level:4');
Route::get('addwebshop', [RegisterController::class, 'addWebshopView'])->middleware('level:4');
Route::post('addwebshop', [ RegisterController::class, 'addWebshop'])->middleware('level:4');
