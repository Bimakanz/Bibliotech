<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\BookController as StudentBookController;
use App\Http\Controllers\Student\BorrowingController as StudentBorrowingController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)->name('landing');
Route::get('/books/{book}', [LandingController::class, 'show'])->name('landing.books.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::resource('books', AdminBookController::class);
    Route::get('borrowings', [AdminBorrowingController::class, 'index'])->name('borrowings.index');
    Route::patch('borrowings/{borrowing}', [AdminBorrowingController::class, 'update'])->name('borrowings.update');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('books', [StudentBookController::class, 'index'])->name('books.index');
    Route::get('books/{book}', [StudentBookController::class, 'show'])->name('books.show');
    Route::post('books/{book}/borrow', [StudentBorrowingController::class, 'store'])->name('books.borrow');
    Route::get('borrowings', [StudentBorrowingController::class, 'index'])->name('borrowings.index');
});

require __DIR__.'/auth.php';
