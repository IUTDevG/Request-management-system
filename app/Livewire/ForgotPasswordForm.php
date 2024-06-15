<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPasswordForm extends Component
{
    public $email;
    public function sendResetLink() : void {
        $this->validate([
            'email'=> 'email|required|string',
        ]);
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
        redirect()->route('student.login');

    }
    public function render()
    {
        return view('livewire.pages.auth.forgot-password-form')->layout('livewire.layout.auth');
    }
}
