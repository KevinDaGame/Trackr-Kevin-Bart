<?php

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

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/packages', function () {
    return view('packages', [
        'packages' => Package::with(['sender', 'recipient'])->get()
    ]);
});

Route::get('/customers', function () {
    return view('customers', [
        'customers' => Recipient::all()]);
});
