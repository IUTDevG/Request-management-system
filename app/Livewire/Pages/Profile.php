<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount(): void
    {
        $this->id = auth()->user()->id;
        $user = User::query()->find($this->id);
        $this->name = $user->name;
        $this->firstName = $user->firstName;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->avatarUrl = $user->google_profile ?:
            ($user->avatar ? Storage::url($user->avatar)
                : 'https://ui-avatars.com/api/?name=' . $user->name . '+' . $user->firstName
                . '&background=random&bold=true&rounded=true&format=svg&size=512');
        $this->user = $user;
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
                } //  sinn si l'image est là et commence par https:// ou http://
                else if ($user->google_profile) {
                    $user->google_profile = null;
                }

                // Enregistrer la nouvelle image
                $avatarPath = $this->newAvatar->store('avatars', 'public');
                $user->avatar = $avatarPath;
                $this->avatarUrl = Storage::url($avatarPath);
            }

            $user->update();
            DB::commit();
            session()->flash('saved-success', 'Profile updated successfully.');
            $this->newAvatar = null;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while updating your profile.');
        }
    }

    public function changePassword(): void
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required|min:6',
        ]);
        // Vérifier si le mot de paq                                                                                                                                                         asse actuel est correct
        if (!Hash::check($this->current_password, Auth::user()->password)) {
            session()->flash('password-error', 'Le mot de passe actuel est incorrect.');
            return;
        }
        // Mettre à jour le mot de passe
        User::query()->find(Auth::user()->id)->update([
            'password' => Hash::make($this->new_password),
        ]);

        session()->flash('password-success', 'Mot de passe mis à jour avec succès.');

        // Réinitialiser les champs du formulaire
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
