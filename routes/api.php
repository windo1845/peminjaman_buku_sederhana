<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::get('/books', [BookController::class, 'buku']);
Route::get('/books/{code}', [BookController::class, 'kodebuku']);
Route::post('/books', [BookController::class, 'postbuku']);
Route::put('/books/{code}', [BookController::class, 'kodebukuput']);
Route::delete('/books/{code}', [BookController::class, 'kodebukudelete']);