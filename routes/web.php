<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/a', function () {
    return view('welcome');
});

Route::get('/', Home::class);

Route::get('/register', Register::class);
Route::get('/login', Login::class)->name('login');