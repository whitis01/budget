<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/**
 * TODO: King, figure out how to move this into a service provider.
 */
use Periods\PeriodsController;
use Periods\Accounts\AccountsController;
use Periods\Charts\ChartsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    $p = ['Isaac', 'White'];
    return view('welcome');
});

Route::get('localapi', PeriodsController::class . '@api')->name('localapi');

// Period Specific
Route::group([ 'prefix' => 'periods' ] , function() {
    Route::get('/', PeriodsController::class.'@index')->name('periods');

    Route::get('{period}', PeriodsController::class.'@show')->name('periods.periodId');

    Route::post('/', PeriodsController::class.'@store');

    Route::delete('{period}', PeriodsController::class.'@destroy');

    // Accounts Specific
    Route::group([ 'prefix' => '{period}/accounts' ], function() {
        Route::post('/', AccountsController::class.'@store');

        Route::get('{account}', AccountsController::class.'@index')->name('accounts.accountId');

        Route::patch('{account}', AccountsController::class.'@edit');

        Route::delete('{account}', AccountsController::class.'@destroy');
    });

    // Chart time
    Route::group(['prefix' => '{period}/charts'], function() {
        Route::get('/', ChartsController::class . '@index')->name('charts');

        Route::get('only', ChartsController::class . '@indexOnly')->name('charts.only');

//        Route::get('{chart}', ChartsController::class . '@index')->name('charts.chartId');
    });
});

