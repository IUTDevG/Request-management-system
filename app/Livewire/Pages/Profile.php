<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layout.student'), Title('Profile')]
class Profile extends Component
{
    public $avatar;
    public $avatarUrl;
    public $id;
    public $name;
    public $firstName;
    public $username;
    public $email;

    public function mount(): void
    {
        $this->id = auth()->user()->id;
        $user = User::query()->find($this->id);
        $this->name = $user->name;
        $this->firstName = $user->firstName;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => 'required|string|not_regex:/[0-9]/',
            'firstName' => 'nullable|string|not_regex:/[0-9]/',
            'username' => 'string|required',
            'email' => 'required|email|unique:users,email,' . $this->id,
        ]);
        DB::beginTransaction();
        try {

        User::query()->where('id', $this->id)->update([
            'name' => $this->name,
            'firstName' => $this->firstName,
            'username' => $this->username,
            'email' => $this->email,
            'updated_at' => now(),
        ]);
        DB::commit();
        session()->flash('success', 'Profile updated successfully.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while updating your profile.');
        }
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
