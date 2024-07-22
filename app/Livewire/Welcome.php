<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{

    public function render()
    {
        sleep(seconds: 0.5);
        return view('livewire.welcome');
    }
}
