<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->as('admin.')->group(function (){
    Route::get('/login', [AdminLoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'adminLogin'])->name('submit.login');
    Route::post('/logout', [AdminLoginController::class, 'adminLogout'])->name('logout');
});

Route::group(['middleware' => ['auth:admin']], function (){
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin-home');
});
