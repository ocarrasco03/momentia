<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::group(['prefix' => 'accounts'], function () {
        //     Route::get();
        //     Route::post();
        });

        Route::group(['prefix' => 'events'], function () {
            // Route::get('/');
            // Route::post('/');
            // Route::get('{id}');
            // Route::put('{id}');
            // Route::delete('{id}');

            Route::group(['prefix' => '{id}'], function () {
                // Route::get('guests');
                // Route::post('guests');

                // Route::get('tables');
                // Route::post('tables');

                // Route::get('gallery');
            });
        });

        Route::group(['prefix' => 'guests'], function () {
            // Route::post('imports');
        });

        Route::group(['prefix' => 'rsvps'], function () {
            // Route::post('{token}');
        });

        Route::group(['prefix' => 'tables'], function () {
            // Route::put('{id}');
        });

        Route::group(['prefix' => 'checkins'], function () {
            // Route::post('{qr}');
        });

        Route::group(['prefix' => 'gallery'], function () {
            // Route::post('upload');
            // Route::post('{id}/approve');
            // Route::get('download/{event}');
        });

        Route::group(['prefix' => 'whatsapp'], function () {
            // Route::post('send');
        });

    });
});



