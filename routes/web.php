<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'as' => 'books.'], function () {
    Route::get('/', [BooksController::class, 'index'])->name('index');
    Route::get('/create', [BooksController::class, 'create'])->name('create');
});

Route::group(['prefix' => '/genres', 'as' => 'genres.'], function () {
    Route::get('/', [GenresController::class, 'index'])->name('index');
    Route::get('/create', [GenresController::class, 'create'])->name('create');
});

Route::group(['prefix' => '/authors', 'as' => 'authors.'], function () {
    Route::get('/', [AuthorsController::class, 'index'])->name('index');
    Route::get('/create', [AuthorsController::class, 'create'])->name('create');
});
