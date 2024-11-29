<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
use App\Livewire\Profile\ProfileUser;
use Illuminate\Support\Facades\Route;

Route::get('/a', function () {
    return view('welcome');
});

// ------------------ Access - User ------------------- //
Route::get('/register', Register::class);
Route::get('/login', Login::class)->name('login');

// ------------------- Home-Page --------------------- //
Route::get('/', Home::class);

// ---------------- Profile - User ------------------- //
Route::get('/profile', ProfileUser::class);