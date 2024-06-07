<?php

use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('books');
});

Route::get('/authors', function () {
    return view('authors');
});

Route::group(['prefix' => '/genres', 'as' => 'genres.'], function () {
    Route::get('/', [GenresController::class, 'index'])->name('index');
    Route::get('/create', [GenresController::class, 'create'])->name('create');
});
