<?php

use App\Livewire\Pet\Pets;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('welcome');
Route::get('/pets', Pets::class)->name('pets');
