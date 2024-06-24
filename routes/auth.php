<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get('login', \App\Livewire\LoginForm::class)->name('login');
    Route::get('register', \App\Livewire\RegisterForm::class)->name('register');

    Route::get('forgot-password', \App\Livewire\ForgotPasswordForm::class)
        ->name('student.forgot-password');

    Route::get('reset-password/{token}', ResetPassword::class)
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/', \App\Livewire\StudentDashboard::class)
            ->name('student.home');
        Route::get('/notifications', \App\Livewire\Notifications::class)->name('student.notifications');
        Route::get('/new-request', \App\Livewire\Pages\NewRequest::class)->name('student.new-request');
        Route::get('request/{id}', \App\Livewire\Pages\RequestDetails::class)->name('student.request.details');
        Route::get('/profile', \App\Livewire\Pages\Profile::class)->name('student.profile');
    });

    Route::get('/logout', function () {
        auth()->logout();
        return redirect(route('login'));
    })->name('student.logout');

    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Volt::route('confirm-password', 'pages.auth.confirm-password')
    //     ->name('password.confirm');
});
