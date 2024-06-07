<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;

// The `laniakea.request` is requried here because we're using the resource model bindings in edit routes.
// Since the Laniakea's model binding requires ResourceRequestInterface, we need to make sure that the request is set.
Route::group(['middleware' => ['laniakea.request']], function () {
    Route::group(['prefix' => '/', 'as' => 'books.'], function () {
        Route::get('/', [BooksController::class, 'index'])->name('index');
        Route::get('/books/create', [BooksController::class, 'create'])->name('create');
        Route::get('/books/{book}/edit', [BooksController::class, 'edit'])->name('edit');
    });

    Route::group(['prefix' => '/genres', 'as' => 'genres.'], function () {
        Route::get('/', [GenresController::class, 'index'])->name('index');
        Route::get('/create', [GenresController::class, 'create'])->name('create');
    });

    Route::group(['prefix' => '/authors', 'as' => 'authors.'], function () {
        Route::get('/', [AuthorsController::class, 'index'])->name('index');
        Route::get('/create', [AuthorsController::class, 'create'])->name('create');
    });
});
