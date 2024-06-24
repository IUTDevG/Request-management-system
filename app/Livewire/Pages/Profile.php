<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layout.student'), Title('Profile')]
class Profile extends Component
{
    public function updateProfile(): void
    {

    }
    public function render()
    {
        return view('livewire.pages.profile');
    }
}
