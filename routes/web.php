<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/language',\App\Livewire\Settings\LanguageSwitcher::class)->name('language');

require __DIR__.'/auth.php';
