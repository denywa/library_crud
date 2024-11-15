<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibrarianController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/librarian/dashboard', function () {
    return view('librarian.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin']);

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('/books', \App\Http\Controllers\BookController::class);
    Route::resource('/journals', \App\Http\Controllers\JournalController::class);
    Route::resource('/newspapers', \App\Http\Controllers\NewspaperController::class);
    Route::resource('/cds', \App\Http\Controllers\CdController::class);
    Route::resource('/users', \App\Http\Controllers\UserController::class);
});

Route::prefix('librarian')->middleware(['auth', 'librarian'])->group(function () {
    Route::resource('/books', \App\Http\Controllers\BookController::class);
    Route::resource('/journals', \App\Http\Controllers\JournalController::class);
    Route::resource('/newspapers', \App\Http\Controllers\NewspaperController::class);
    Route::resource('/cds', \App\Http\Controllers\CdController::class);
});


