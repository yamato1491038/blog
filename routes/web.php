<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AddressController;

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
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::resources(['address' => AddressController::class]);

Route::group(['middleware' => ['auth']], function(){
    Route::get('/address/index', 'App\Http\Controllers\AddressController@index');
    Route::get('/address/export', 'App\Http\Controllers\AddressController@csvDownload')->name('export');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
