<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// *****
// Merchant Routes
// *****

Route::prefix('merchant')->name('merchant.')->group(
    function () {
        Route::view('/', 'merchant.index')->name('index');
        Route::view('/register', 'merchant.auth.register')->name('register');
        Route::view('/login', 'merchant.auth.login')->name('login');
    }
);
