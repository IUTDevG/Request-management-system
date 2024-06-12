<?php

namespace App\Livewire;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginForm extends Component
{
    public string $email;

    public string $password;
    public bool $remember = false;

    public function submitForm()
    {
        $this->validate([
            'email' => 'required|email|max:255',
            'password' => ['required', Password::min(6)]
        ]);
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->flash('error', 'Données d\'authentification incorrect');
//             redirect()->route('login');

        } else {
            session()->flash('success', 'Connexion reussie');
             redirect()->route('student.home');
        }

    }
    public function render()
    {
        return view('livewire.pages.auth.login-form')->layout('livewire.layout.auth');
    }
}
