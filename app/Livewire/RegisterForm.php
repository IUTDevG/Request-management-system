<?php

namespace App\Livewire;

use App\Models\User;
use App\Enums\RoleType;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

    class RegisterForm extends Component
{
    public string $name;
    public ?string $matricule;
    public string $email;
    public string $password;
    public string $password_confirmation;

    public function submitForm()
    {
        $this->validate([
            'name'=>'required',
            'email' => 'required|unique:users,email|email',
            'matricule'=>'required|max:7|min:7|unique:users,matricule',
            'password'=> 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if (isset($_SERVER['HTTP_CLIENT_IP']) && array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ips = array_map('trim', $ips);
            $ip = $ips[0];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        }

        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ($ip === false) ? '0.0.0.0' : $ip;

        $user =  new User([
            'name' => $this->name,
            'username' => Str::slug($this->name),
            'email' => $this->email,
            'password' => $this->password,
            'matricule' => $this->matricule,
            'last_login_at' => now(),
            'last_login_ip' => $ip,
            'is_activated' => true
        ]);
        // dd($user);
        $user->save();
        $user->assignRole(RoleType::STUDENT);

        Auth::attempt($this->only(['email', 'password']),);
        redirect()->route('student.home');

    }

    public function render()
    {
        return view('livewire.pages.auth.register-form')->layout('livewire.layout.auth');
    }
}
