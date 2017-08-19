<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('beta')->group(function () {
    Route::resource('/inventories', 'InventoryController');

    Route::post('/inventories', 'InventoryController@store')->name('store-inventory');

    Route::get('/inventories/ajax/{action}', 'InventoryController@ajax')->name('ajax-inventory');

    Route::get('/{file}', function($file){
        return redirect(url("/demo/$file"));
    });
});