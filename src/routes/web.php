<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/error/{code}', fn ($code) => Inertia::render('Error', compact('code')))->name('error');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/users', fn () => Inertia::render('User/Index'))->name('users.index');
    Route::get('/users/{user}', fn () => Inertia::render('User/Show'))->name('users.show');
    Route::get('/users/{user}/wallets', fn () => Inertia::render('Wallet/Index'))->name('users.wallets.index');
    Route::get('/wallets', fn () => Inertia::render('Wallet/Index'))->name('wallets.index');
    Route::get('/wallets/{wallet}', fn () => Inertia::render('Wallet/Show'))->name('wallets.show');
    Route::get('/wallets/create', fn () => Inertia::render('Wallet/Create'))->name('wallets.create');
});