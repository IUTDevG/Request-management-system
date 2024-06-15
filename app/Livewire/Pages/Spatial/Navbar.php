<?php

namespace App\Livewire\Pages\Spatial;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Navbar extends Component
{
    public string $current;

    public function mount(): void
    {
        $locale = session('language', 'fr');
        App::setLocale($locale);
        $this->current = $locale;
        Log::info('Livewire Mount - Locale set to: ' . $locale);
    }

    public function updateCurrentLanguage($current)
    {
        session(['language' => $current]);
        App::setLocale($current);
        Log::info('Livewire - Session language set to: ' . $current);
        Log::info('Livewire - App locale set to: ' . App::getLocale());
        $currentUrl = request()->headers->get('referer');
        return $this->redirect($currentUrl);
    }

    public function render()
    {
        return view('livewire.pages.spatial.navbar');
    }
}
