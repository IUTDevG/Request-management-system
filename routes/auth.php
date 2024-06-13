<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get('login', \App\Livewire\LoginForm::class)->name('login');
    Route::get('register', \App\Livewire\RegisterForm::class)->name('register');

    Route::get('forgot-password', \App\Livewire\ForgotPasswordForm::class)
        ->name('forgot-password');

    Route::get('reset-password/{token}', ResetPassword::class)
        ->name('reset-password');
});

Route::middleware('auth')->group(function () {

    Route::get('student', \App\Livewire\StudentDashboard::class)
        ->name('student.home');
    Route::get('logout', function (){
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })
        ->name('logout');

    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
