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
use Livewire\Attributes\Layout;

#[Layout('livewire.layout.auth')]
class LoginForm extends Component
{
    public string $email;

    public string $password;
    public bool $remember = false;

    public function submitForm()
{
    $this->validate([
        'email' => 'required|max:255',
        'password' => ['required', Password::min(6)]
    ]);

    $credentials = [
        'password' => $this->password,
        'is_activated' => true
    ];

    if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $credentials['email'] = $this->email;
    } else {
        $credentials['matricule'] = $this->email;
    }

    if (Auth::attempt($credentials, $this->remember)) {
        $user = Auth::user();
        session()->flash('success', __('Connexion réussie'));

        if ($user->hasRole(RoleType::COMPUTER_CELL)) {
            return redirect()->to('/admin');
        } elseif ($user->hasRole(RoleType::ACADEMIC_MANAGER) || $user->hasRole(RoleType::DEPUTY_DIRECTOR) || $user->hasRole(RoleType::SCHOOLING) || $user->hasRole(RoleType::SECRETARY_DIRECTOR ) || $user->hasRole(RoleType::DIRECTOR) || $user->hasRole(RoleType::HEAD_OF_DEPARTMENT)) {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->route('student.home');
        }
    }

    session()->flash('error', __('Données d\'authentification incorrectes'));
    return redirect()->back()->withInput($this->except('password'));
}
    public function render()
    {
        return view('livewire.pages.auth.login-form');
    }
}
