<?php

namespace App\Livewire\Layout;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
#[ Layout('livewire.layout.student'), Title('Accueil')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.layout.dashboard')->layout('livewire.layout.student');
    }
}
