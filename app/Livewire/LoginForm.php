<?php

namespace App\Livewire;

use App\Enums\RoleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layout.auth')]
class LoginForm extends Component
{
    public string $email;

    public string $password;
    public bool $remember = false;

    /*public function submitForm()
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
}*/
    protected $rules = [
        'email' => 'required|max:255',
        'password' => ['required', 'min:6'],
    ];

    public function submitForm()
    {
        $this->validate();

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

            session()->flash('success', __('Successfully logged in, redirecting...'));

            if ($user->hasRole(RoleType::COMPUTER_CELL)) {
                $this->js("setTimeout(() => window.location.href = '/admin', 3000)");
            } elseif ($user->hasAnyRole([
                RoleType::ACADEMIC_MANAGER,
                RoleType::DEPUTY_DIRECTOR,
                RoleType::SCHOOLING,
                RoleType::SECRETARY_DIRECTOR,
                RoleType::DIRECTOR,
                RoleType::HEAD_OF_DEPARTMENT
            ])) {
                $this->js("setTimeout(() => window.location.href = '/dashboard', 3000)");
            } else {
                $this->js("setTimeout(() => window.location.href = '".route('student.home')."', 3000)");
            }

        } else {
            session()->flash('error', __('Incorrect login credentials'));
            return redirect()->back()->withInput($this->except('password'));
        }
    }
    public function render()
    {
        return view('livewire.pages.auth.login-form');
    }
}
