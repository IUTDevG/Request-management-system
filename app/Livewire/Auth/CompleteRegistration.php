<?php

namespace App\Livewire\Auth;

use App\Enums\RoleType;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Events\Auth\Registered;

#[Title('Registered'), Layout('livewire.layout.register')]
class CompleteRegistration extends Component
{
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'nullable|string|min:8|confirmed',
    ];

    public function mount()
    {
        if (!session('social_user')) {
            return redirect()->route('login');
        }
        $this->username = session('social_user')['username'];
    }

    public function completeRegistration()
    {
        $this->validate();

        $socialUser = session('social_user');

        $userData = [
            'name' => $socialUser['name'],
            'email' => $socialUser['email'],
            'username' => $this->username,
            $socialUser['provider'] . '_id' => $socialUser['provider_id'],
            'google_profile' => $socialUser['google_profile'],
        ];

        if ($this->password) {
            $userData['password'] = Hash::make($this->password);
        } else {
            $userData['password'] = Hash::make(Str::random(16));
        }

        $user = User::create($userData);
        $user->assignRole(RoleType::STUDENT);

        event(new Registered($user));
        Auth::login($user, remember: true);
        session()->forget('social_user');

        return redirect()->route('student.home');
    }

    public function render()
    {
        return view('livewire.auth.complete-registration');
    }
}
