<?php

use App\Http\Controllers\GenresApiController;
use Illuminate\Support\Facades\Route;

// The `laniakea.request` middleware is required on all API routes that utilizes resource manager.
// See: https://laniakea.zurbaev.com/getting-started.html#use-middleware
Route::group(['middleware' => ['laniakea.request'], 'as' => 'api.'], function () {

    // The `laniakea.version` middleware is required on all API routes that utilizes (or plans to utilize) versioning.
    Route::group(['prefix' => '/v1', 'middleware' => ['laniakea.version:v1'], 'as' => 'v1.'], function () {
        Route::group(['prefix' => '/genres', 'as' => 'genres.'], function () {
            Route::get('/', [GenresApiController::class, 'index'])->name('index');
            Route::post('/', [GenresApiController::class, 'store'])->name('store');
            Route::get('/{genre}', [GenresApiController::class, 'show'])->name('show');
        });
    });
});
