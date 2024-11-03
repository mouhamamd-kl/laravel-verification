<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\MerchantEnsureEmailIsVerified;
use App\Http\Middleware\MerchantMiddleware;
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

Route::prefix('merchant')->name('merchant.')->group(function () {

    // Public routes (login, register) without middleware
  

    // Routes that require authentication
    Route::middleware([MerchantMiddleware::class,MerchantEnsureEmailIsVerified::class])->group(function(){
        Route::view('/', 'merchant.index')->name('index');
    });

    require __DIR__ . '/merchantAuth.php'; // If you need more authenticated merchant routes
});
