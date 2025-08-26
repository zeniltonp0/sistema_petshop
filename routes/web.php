<?php

use App\Livewire\Auth\{Login, Register};
use App\Livewire\Pet\Pets;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', Welcome::class)->name('welcome');
    Route::get('/pets', Pets::class)->name('pets');
});
