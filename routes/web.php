<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Layout\Home::class)->name('home');
Route::get('/language',\App\Livewire\Settings\LanguageSwitcher::class)->name('language');
Route::redirect('/admin', env('ADMIN_DOMAIN'));
Route::redirect('/dashboard', env('DASHBOARD_DOMAIN'));

require __DIR__.'/auth.php';
