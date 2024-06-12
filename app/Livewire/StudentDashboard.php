<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Accueil')]
class StudentDashboard extends Component
{
    public function logout(): void
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();

        redirect('/');
    }

    public function render()
    {
        return view('livewire.student-dashboard')->layout('livewire.layout.student');
    }
}
