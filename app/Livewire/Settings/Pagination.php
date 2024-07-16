<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\WithPagination;

class Pagination extends Component
{
    use WithPagination;

    public $paginator;

    public function mount($paginator)
    {
        $this->paginator = $paginator;
    }

    public function render()
    {
        return view('livewire.settings.pagination', [
            'paginator' => $this->paginator,
        ]);
    }
}

