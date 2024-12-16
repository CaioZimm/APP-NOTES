<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
use App\Livewire\Notes\EditNote;
use App\Livewire\Notes\ShowNotes;
use App\Livewire\Profile\ProfileUser;
use App\Livewire\StopWatch\Main;
use Illuminate\Support\Facades\Route;

Route::get('/a', function () {
    return view('welcome');
});

// ------------------- Home-Page --------------------- //
Route::get('/', Home::class)->name('home');

// ------------------ Access - User ------------------- //
Route::get('/register', Register::class)->name('register');;
Route::get('/login', Login::class)->name('login');

Route::middleware('auth')->group(function(){
    // ---------------- Profile - User ------------------- //
    Route::get('/profile', ProfileUser::class)->name('profile');
    
    // ----------------- Page - Notes -------------------- //
    Route::get('/notes', ShowNotes::class)->name('notes');
    Route::get('/notes/{note}', EditNote::class)->name('notes-edit');

    // ----------------- Page - StopWatch -------------------- //
    Route::get('/stopwatch', Main::class)->name('stopwatch');
});