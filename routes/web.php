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
    return redirect(route('inventory-index'));
})->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['check-demo-user']], function () {
    Route::prefix('beta')->group(function () {
        Route::prefix('inventories')->group(function () {
            Route::get('/', 'InventoryController@index')->name('inventory-index');
            Route::post('/', 'InventoryController@store')->name('inventory-store');
            Route::get('ajax/{action}', 'InventoryController@ajax')->name('inventory-ajax');
            Route::post('{inventory}/files', 'InventoryController@storeFiles')->name('inventory-files');
            Route::get('{inventory}/files', 'InventoryController@refreshPanelFiles')->name('inventory-files-refresh');
            Route::get('images/{inventoryFile}', 'InventoryController@getImageFile')->name('inventory-image-file');
            Route::get('file/{inventoryFile}/download', 'InventoryController@downloadFile')->name('inventory-file-download');
            Route::get('file/{inventoryFile}/preview', 'InventoryController@previewFile')->name('inventory-file-preview');
            Route::get('file/{inventoryFile}/delete', 'InventoryController@deleteFormFile')->name('inventory-file-form-delete');
            Route::delete('file/{inventoryFile}/delete', 'InventoryController@deleteFile')->name('inventory-file-delete');
        });

        Route::prefix('reports')->group(function(){
            Route::get('/phase-2','InventoryController@downloadReportPhase2')->name('reports-phase-2');
            Route::get('/phase-3','InventoryController@downloadReportPhase3')->name('reports-phase-3');
        });

        /* For demo pages */
        Route::get('/{file}', function($file){
            if( Auth::guest() ){
                return view('welcome');
            }
            return redirect(url("/demo/$file"));
        });
    });
});