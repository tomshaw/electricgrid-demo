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

Volt::route('/', 'home.table')->name('home');
Volt::route('/dashboard', 'home.table')->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('users', 'users.table')->name('users');
Volt::route('users/update/{user}', 'users.update')->name('users.update');

Volt::route('orders', 'orders.table')->name('orders');
Volt::route('orders/update/{order}', 'orders.update')->name('orders.update');

require __DIR__ . '/auth.php';
