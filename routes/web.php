<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// ---- Auth (no Kernel edits needed) ----
Route::get('/login',  [LoginController::class, 'show'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ---- App (must be logged in) ----
Route::middleware('auth')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('home');

    // Everyone can access Orders
    Route::get('/order',        [OrderController::class, 'index'])->name('order');
    Route::get('/orders/data',  [OrderController::class, 'data'])->name('orders.data');
    Route::get('/orders/ref-data', [OrderController::class, 'refData'])->name('orders.ref');
    Route::post('/order',       [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{fis}',  [OrderController::class, 'show'])->name('order.show');
    Route::put('/order/{fis}',  [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{fis}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/{fis}/items', [OrderDetayController::class, 'listByFis'])->name('orderdetay.byfis');

    // OrderDetay
    Route::get('/orderdetay',           [OrderDetayController::class, 'index'])->name('orderdetay');
    Route::get('/orderdetay/data',      [OrderDetayController::class, 'data'])->name('orderdetay.data');
    Route::get('/orderdetay/{id}',      [OrderDetayController::class, 'show'])->name('orderdetay.show');
    Route::put('/orderdetay/{id}',      [OrderDetayController::class, 'update'])->name('orderdetay.update');
    Route::delete('/orderdetay/{id}',   [OrderDetayController::class, 'destroy'])->name('orderdetay.destroy');

    // Offers
    Route::get('/offer',        [OfferController::class, 'index'])->name('offer.index');
    Route::get('/offer/data',   [OfferController::class, 'data'])->name('offer.data');
    Route::post('/offer',       [OfferController::class, 'store'])->name('offer.store');
    Route::get('/offer/{id}',   [OfferController::class, 'show'])->name('offer.show');
    Route::put('/offer/{id}',   [OfferController::class, 'update'])->name('offer.update');
    Route::delete('/offer/{id}', [OfferController::class, 'destroy'])->name('offer.destroy');

    // Users
    Route::get('/user',         [UserController::class, 'index'])->name('user.index');
    Route::get('/user/data',    [UserController::class, 'data'])->name('user.data');
    Route::get('/user/{id}',    [UserController::class, 'show'])->name('user.show');
    Route::post('/user',        [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}',    [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // --- Admin-only routes ---
    Route::middleware('admin')->group(function () {});

    // Profile
    Route::view('/profile', 'profile')->name('profile');
});
