<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('livewire.layout.student'), Title('Profile')]
class Profile extends Component
{
    use WithFileUploads;
public $user;
    public $avatar;
    public $avatarUrl;
    public $id;
    public $name;
    public $firstName;
    public $username;
    public $email;
    public $newAvatar;

    public function mount(): void
    {
        $this->id = auth()->user()->id;
        $user = User::query()->find($this->id);
        $this->name = $user->name;
        $this->firstName = $user->firstName;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->avatarUrl = $user->avatar ? Storage::url($user->avatar) : null;
        $this->user=$user;
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => 'required|string|not_regex:/[0-9]/',
            'firstName' => 'nullable|string|not_regex:/[0-9]/',
            'username' => 'string|required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'newAvatar' => 'nullable|image|max:1024', // max 1MB
        ]);
        DB::beginTransaction();
        try {

            $user = User::query()->find($this->id);

            $user->name = $this->name;
            $user->firstName = $this->firstName;
            $user->username = $this->username;
            $user->email = $this->email;

            if ($this->newAvatar) {
                // Supprimer l'ancienne image si elle existe
                if ($user->avatar) {
                    Storage::delete($user->avatar);
                }

                // Enregistrer la nouvelle image
                $avatarPath = $this->newAvatar->store('avatars', 'public');
                $user->avatar = $avatarPath;
                $this->avatarUrl = Storage::url($avatarPath);
            }

            $user->save();
            DB::commit();
            session()->flash('success', 'Profile updated successfully.');
            $this->newAvatar = null;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while updating your profile.');
        }
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
