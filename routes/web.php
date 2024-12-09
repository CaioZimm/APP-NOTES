<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
use App\Livewire\Notes\EditNotes;
use App\Livewire\Notes\ShowNotes;
use App\Livewire\Profile\ProfileUser;
use App\Livewire\StopWatch\Timer;
use Illuminate\Support\Facades\Route;

Route::get('/a', function () {
    return view('welcome');
});

// ------------------ Access - User ------------------- //
Route::get('/register', Register::class)->name('register');;
Route::get('/login', Login::class)->name('login');

// ------------------- Home-Page --------------------- //
Route::get('/', Home::class)->name('home');

// ---------------- Profile - User ------------------- //
Route::get('/profile', ProfileUser::class)->name('profile');

// ----------------- Page - Notes -------------------- //
Route::get('/notes', ShowNotes::class)->name('notes');
// Route::get('/notes/{note}', EditNotes::class)->name('notes-edit');

// ----------------- Page - StopWatch -------------------- //
Route::get('/stopwatch', Timer::class)->name('stopwatch');