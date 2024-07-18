<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $current;

    public function mount(): void
    {
        $this->current = session('language', 'en');
    }

    public function updateCurrentLanguage($current)
    {
        $this->current = $current;
        session(['language' => $this->current]);

        $currentUrl=session('_previous')['url'];
        return redirect($currentUrl);
    }

    public function render()
    {
        return view('livewire.settings.language-switcher');
    }
}
