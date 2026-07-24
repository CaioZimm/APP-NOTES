<?php

use App\Livewire\Password\ConfirmationNewPassword;
use App\Livewire\Password\ResetPassword;
use \App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Profile\ProfileUser;
use App\Livewire\Notes\CreateNote;
use App\Livewire\Notes\ShowNotes;
use App\Livewire\Notes\EditNote;
use App\Livewire\StopWatch\Main;
use App\Livewire\Auth\Register;
use App\Livewire\Notes\Trash;
use App\Livewire\Auth\Login;
use App\Livewire\Tags\Index;
use Illuminate\Http\Request;
use App\Livewire\Home;

Route::get('/a', function () {
    return view('welcome');
});

// ------------------- Home-Page --------------------- //
Route::get('/', Home::class)->name('home');

Route::middleware(['guest', 'throttle:10,1'])->group(function () {
    // ------------------ Access - User ------------------- //
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');

    // ------------------ Forgot - Password ------------------- //
    Route::get('/reset-password', ResetPassword::class)->name('reset-password');
    Route::get('/new-password', ConfirmationNewPassword::class)->name('new-password');
});

// ----------------- Page - StopWatch -------------------- //
Route::get('/stopwatch', Main::class)->name('stopwatch');

Route::middleware('auth')->group(function(){
    // ---------------- Profile - User ------------------- //
    Route::get('/profile', ProfileUser::class)->name('profile');

    // ----------------- Page - Notes -------------------- //
    Route::get('/notes', ShowNotes::class)->name('notes');
    Route::get('/notes/{note}', EditNote::class)->name('notes-edit');
    Route::get('/notes/trash', Trash::class)->name('notes.trash');
    
    // ----------------- Page - Tags -------------------- //
    Route::get('/tags', Index::class)->name('tags.index');
    
    // ----------------- Dashboard -------------------- //
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});