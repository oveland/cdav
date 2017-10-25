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
    if (Auth::guest()) {
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

            Route::prefix('files')->group(function () {
                Route::post('/{inventory}', 'InventoryFileController@storeFiles')->name('inventory-files');
                Route::get('/{inventory}', 'InventoryFileController@refreshPanelFiles')->name('inventory-files-refresh');
                Route::get('images/{inventoryFile}', 'InventoryFileController@getImageFile')->name('inventory-file-image');
                Route::get('/{inventoryFile}/download', 'InventoryFileController@downloadFile')->name('inventory-file-download');
                Route::get('/{inventoryFile}/preview', 'InventoryFileController@previewFile')->name('inventory-file-preview');
                Route::get('/{inventoryFile}/delete', 'InventoryFileController@deleteFormFile')->name('inventory-file-form-delete');
                Route::delete('/{inventoryFile}/delete', 'InventoryFileController@deleteFile')->name('inventory-file-delete');
            });
        });

        Route::prefix('reports')->group(function () {
            Route::prefix('phase-2')->group(function () {
                Route::get('/started', 'InventoryReportController@downloadReportPhase2')->name('reports-phase-2');
                Route::get('/personal', 'InventoryReportController@downloadReportPersonalPhase2')->name('reports-personal-notification-phase-2');
                Route::get('/notice', 'InventoryReportController@downloadReportNoticePhase2')->name('reports-notice-notification-phase-2');
            });

            Route::prefix('phase-3')->group(function () {
                Route::get('/started', 'InventoryReportController@downloadReportPhase3')->name('reports-phase-3');
                Route::get('/personal', 'InventoryReportController@downloadReportPersonalPhase3')->name('reports-personal-notification-phase-3');
                Route::get('/notice', 'InventoryReportController@downloadReportNoticePhase3')->name('reports-notice-notification-phase-3');
            });
        });

        /* For demo pages */
        Route::get('/{file}', function ($file) {
            if (Auth::guest()) {
                return view('welcome');
            }
            return redirect(url("/demo/$file"));
        });
    });
});