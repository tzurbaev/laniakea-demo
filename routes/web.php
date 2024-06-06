<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('books');
});

Route::get('/authors', function () {
    return view('authors');
});

Route::get('/genres', function () {
    return view('genres');
});
