<?php

namespace App\Livewire;

use App\Models\SchoolRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Accueil')]
class StudentDashboard extends Component
{


    public function render()
    {
        $requests = SchoolRequest::query();
        return view('livewire.student-dashboard', [
            'requests' => $requests->paginate(4),
        ])->layout('livewire.layout.student');
    }
}
