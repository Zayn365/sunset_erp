<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AdminController::class,'index'])->name('home');
Route::get('/login', function () {
    return view('login');
});
Route::get('/user', function () {
    return view('user');
});
Route::get('/order',[OrderController::class,'index']);
