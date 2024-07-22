<?php

namespace App\Livewire\Layout;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('components.layouts.app')]
class Home extends Component
{

    public function render()
    {
        return view('livewire.layout.home');
    }
}
