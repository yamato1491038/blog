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



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::resources(['address' => AddressController::class]);

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'App\Http\Controllers\AddressController@index')->name('address.index');
    Route::get('/address/index', 'App\Http\Controllers\AddressController@index')->name('address.index');
    Route::get('/address/create', 'App\Http\Controllers\AddressController@create')->name('address.create');
    Route::post('/address/store', 'App\Http\Controllers\AddressController@store')->name('address.store');

    Route::get('/my_image/show', 'App\Http\Controllers\MyImageController@show')->name('my_image.show');
    Route::post('/my_image/upload', 'App\Http\Controllers\MyImageController@upload')->name('my_image.upload');

    Route::get('/address/export', 'App\Http\Controllers\AddressController@csvDownload')->name('address.export');


    Route::get('/group/create', 'App\Http\Controllers\GroupController@create')->name('group.create');
    Route::post('/group/store', 'App\Http\Controllers\GroupController@store')->name('group.store');
    Route::delete('/group/destroy', 'App\Http\Controllers\GroupController@destroy')->name('group.destroy');

    Route::post('/like/store', 'App\Http\Controllers\LikeController@store')->name('like.store');
    Route::delete('/like/destroy', 'App\Http\Controllers\LikeController@destroy')->name('like.destroy');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'address/index']);
});

Auth::routes();


