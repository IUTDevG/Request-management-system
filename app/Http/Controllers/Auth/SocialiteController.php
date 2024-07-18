<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Filament\Events\Auth\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Image;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function loginSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($request);

        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($request);

        $socialUser = Socialite::driver($provider)->user();

        $email = $socialUser->getEmail();
        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => "L'email n'a pas pu être récupéré depuis $provider."]);
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            // Mise à jour des informations existantes
            $this->updateUserAvatar($user, $socialUser->getAvatar());
            $user->update([
                $provider . '_id' => $socialUser->getId(),
                'username' => $user->username ?? $socialUser->getNickname(),
            ]);
            Auth::login($user, remember: true);
            return redirect()->route('student.home');
        }

        // Stocker les informations de l'utilisateur en session
        $avatarPath = $this->storeAvatar($socialUser->getAvatar());
        session([
            'social_user' => [
                'name' => $socialUser->getName(),
                'email' => $email,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $avatarPath,
                'username' => $socialUser->getNickname(),
            ]
        ]);

        // Rediriger vers un formulaire pour confirmer ou modifier le nom d'utilisateur
        return redirect()->route('social.username');
    }

    public function completeRegistration(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
        ]);

        $socialUser = session('social_user');

        if (!$socialUser) {
            return redirect()->route('login');
        }

        $user = User::create([
            'name' => $socialUser['name'],
            'email' => $socialUser['email'],
            'username' => $request->username,
            'password' => Str::password(),
            $socialUser['provider'] . '_id' => $socialUser['provider_id'],
            'avatar' => $socialUser['avatar'],
        ]);

        event(new Registered($user));

        Auth::login($user, remember: true);

        // Nettoyer la session
        session()->forget('social_user');

        return redirect()->route('student.home');
    }

    protected function storeAvatar($avatarUrl): string
    {
        $avatarContent = file_get_contents($avatarUrl);
        $filename = 'avatars/' . Str::random(40) . '.jpg';

        Storage::put('public/' . $filename, $avatarContent);
        return $filename;
    }

    protected function updateUserAvatar(User $user, $newAvatarUrl): void
    {
        // Supprimer l'ancien avatar s'il existe
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        // Stocker le nouvel avatar
        $avatarPath = $this->storeAvatar($newAvatarUrl);
        $user->avatar = $avatarPath;
        $user->save();
    }

    public function showUsernameForm()
    {
        if (!session('social_user')) {
            return redirect()->route('login');
        }
//dd(session('social_user'));
        $suggestedUsername = session('social_user')['username'];

        return view('auth.social-username', compact('suggestedUsername'));
    }

    protected function validateProvider(Request $request): array
    {
        return Validator::make(
            $request->route()->parameters(),
            ['provider' => 'in:google,github']
        )->validate();
    }
}
