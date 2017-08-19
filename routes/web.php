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
    if( Auth::guest() ){
        return view('welcome');
    }
    return redirect(route('index-inventory'));
})->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['check-demo-user']], function () {
    Route::prefix('beta')->group(function () {
        Route::resource('/inventories', 'InventoryController');
        Route::get('/inventories', 'InventoryController@index')->name('index-inventory');
        Route::post('/inventories', 'InventoryController@store')->name('store-inventory');
        Route::get('/inventories/ajax/{action}', 'InventoryController@ajax')->name('ajax-inventory');

        /* For demo pages */
        Route::get('/{file}', function($file){
            if( Auth::guest() ){
                return view('welcome');
            }
            return redirect(url("/demo/$file"));
        });
    });
});