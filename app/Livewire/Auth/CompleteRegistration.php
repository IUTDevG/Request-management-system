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
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ];

    public function mount()
    {
        if (!session('social_user')) {
            return redirect()->route('login');
        }
        $this->first_name = session('social_user')['first_name'];
        $this->last_name = session('social_user')['last_name'];
        $this->username = session('social_user')['username'];
    }

    public function completeRegistration()
    {
        $this->validate();

        $socialUser = session('social_user');
        if (User::where('email', $socialUser['email'])->exists()) {
            return back()->withErrors(['email-error' => __('Email already exists.')]);
        }

        $userData = [
            'name' => $this->first_name . ' ' . $this->last_name,
            'firstName' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $socialUser['email'],
            'username' => $socialUser['username'],
            $socialUser['provider'] . '_id' => $socialUser['provider_id'],
            'google_profile' => $socialUser['google_profile'],
            'password' => $this->password ? Hash::make($this->password) : Hash::make(Str::random(16)),
        ];

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
