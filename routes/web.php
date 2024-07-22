<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Layout\Home::class)->name('home');
Route::get('/language',\App\Livewire\Settings\LanguageSwitcher::class)->name('language');

require __DIR__.'/auth.php';
