<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);

Route::resource('writers', WriterController::class);
Route::get('/writers', [WriterController::class, 'index'])->name('writers.index');
Route::get('/writers/create', [WriterController::class, 'create'])->name('writers.create');
Route::post('/writers', [WriterController::class, 'store'])->name('writers.store');
