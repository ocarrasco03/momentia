<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::fallback(function () {
    throw new NotFoundHttpException();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:api')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::get('me', [AuthController::class, 'me']);
        });
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



