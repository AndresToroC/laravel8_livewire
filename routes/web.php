<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UserLivewire;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    // Livewire
    Route::get('users', UserLivewire::class)->name('users');
});