<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('users', 'users.table')->name('users');
Volt::route('users/create', 'users.create')->name('users.create');
Volt::route('users/update/{user}', 'users.update')->name('users.update');

Volt::route('orders', 'orders.table')->name('orders');
Volt::route('orders/create', 'orders.create')->name('orders.create');
Volt::route('orders/update/{order}', 'orders.update')->name('orders.update');

require __DIR__ . '/auth.php';
