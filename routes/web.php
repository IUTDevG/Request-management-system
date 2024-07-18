<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Route::get('login', \App\Livewire\LoginForm::class)->name('login');
// Route::get('register', \App\Livewire\RegisterForm::class)->name('register');
// Route::view('student', 'dashboard')
//     // ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

require __DIR__.'/auth.php';
