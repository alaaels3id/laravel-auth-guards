<?php

use App\Http\Controllers\Provider\ProviderHomeController;
use App\Http\Controllers\Provider\Auth\ProviderLoginController;
use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->as('provider.')->group(function (){
    Route::get('/login', [ProviderLoginController::class, 'showProviderLoginForm'])->name('login');
    Route::post('/login', [ProviderLoginController::class, 'providerLogin'])->name('submit.login');
    Route::post('/logout', [ProviderLoginController::class, 'providerLogout'])->name('logout');
});

Route::group(['middleware' => ['auth:provider']], function (){
    Route::get('/', [ProviderHomeController::class, 'index'])->name('provider-home');
});
