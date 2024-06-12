<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Notifications')]
class Notifications extends Component
{
    public function render()
    {
        return view('livewire.notifications')->layout('livewire.layout.student');
    }
}
