<?php

namespace App\Livewire;

use App\Enums\RoleType;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginForm extends Component
{
    public string $email;

    public string $password;
    public bool $remember = false;

    public function submitForm(): void
    {
        $this->validate([
            'email' => 'required|max:255',
            'password' => ['required', Password::min(6)]
        ]);
        $user = User::where('email', $this->email)->orWhere('matricule', $this->email)->first();
        if (($user && $user->matricule === null && $user->hasRole(RoleType::STUDENT) ) || !Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_activated' => true], $this->remember) ) {

            if(Auth::attempt(['matricule'=>$this->email, 'password'=>$this->password, 'is_activated' => true], $this->remember)){
                session()->flash('success', __('Connexion réussie'));
                redirect()->route('student.home');
            }
            // dd($user);
            session()->flash('error', 'Données d\'authentification incorrect');
        } else {
            session()->flash('success', 'Connexion réussie');
            redirect()->route('student.home');
        }

    }
    public function render()
    {
        return view('livewire.pages.auth.login-form')->layout('livewire.layout.auth');
    }
}
