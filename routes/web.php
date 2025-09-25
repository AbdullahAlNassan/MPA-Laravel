<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoritesController;

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create'); 
Route::post('/books', [BookController::class, 'store'])->name('books.store');       
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/',        [HomeController::class, 'index'])->name('home');
Route::get('/about',   [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
Route::post('/favorites/{book}', [FavoritesController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{book}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');
Route::post('/favorites/clear', [FavoritesController::class, 'clear'])->name('favorites.clear');