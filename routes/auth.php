<?php

use App\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->domain(env('APP_URL'))->group(function () {
    Route::get('login', \App\Livewire\LoginForm::class)->name('login');
    Route::get('register', \App\Livewire\RegisterForm::class)->name('register');

    Route::get('forgot-password', \App\Livewire\ForgotPasswordForm::class)
        ->name('student.forgot-password');

    Route::get('reset-password/{token}', ResetPassword::class)
        ->name('password.reset');
    Route::get('auth/{provider}/redirect', [\App\Http\Controllers\Auth\SocialiteController::class, 'loginSocial'])
        ->name('socialite.auth');

    Route::get('auth/{provider}/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'callbackSocial'])
        ->name('socialite.callback');
//    Route::get('/auth/social/username', [\App\Http\Controllers\Auth\SocialiteController::class, 'showUsernameForm'])->name('social.username');
    Route::get('/auth/social/complete', \App\Livewire\Auth\CompleteRegistration::class)->name('social.complete');
//    Route::redirect('/auth/social/complete', '/');
});

Route::middleware(['auth', 'student.role'])->domain(env('APP_URL'))->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/', \App\Livewire\Layout\Dashboard::class)
            ->name('student.home');
        Route::get('/notifications', \App\Livewire\Notifications::class)->name('student.notifications');
        Route::get('/request', \App\Livewire\Pages\NewRequest::class)->name('student.request');
        Route::get('request/{request_code}', \App\Livewire\Pages\RequestDetails::class)->name('student.request.details');
        Route::get('updated-request/{request_code}', \App\Livewire\Pages\UpdateRequest::class)->name('student.updated-request');
        Route::get('itinerary-request/{request_code}', \App\Livewire\Pages\ItineraryRequest::class)->name('student.request.itinerary');
        Route::get('/profile', \App\Livewire\Pages\Profile::class)->name('student.profile');
    });

    Route::get('/logout', static function () {
        auth()->logout();
        return redirect(route('login'));
    })->name('student.logout');

});
