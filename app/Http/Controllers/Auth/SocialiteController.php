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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    protected const ALLOWED_PROVIDERS = ['google', 'github'];

    public function loginSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => __("An error occurred while connecting with :provider.", ['provider' => $provider])]);
        }

        $email = $socialUser->getEmail();
        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => __("The email could not be retrieved from :provider.", ['provider' => $provider])]);
        }

        $user = User::firstOrNew(['email' => $email]);

        if ($user->exists) {
            $this->updateExistingUser($user, $socialUser, $provider);
        } else {
            return $this->handleNewUser($socialUser, $provider);
        }

        Auth::login($user, remember: true);
        return redirect()->route('student.home');
    }

    public function completeRegistration(Request $request): RedirectResponse
    {
        $socialUser = session('social_user');

        if (!$socialUser) {
            return $this->redirectWithError('login', __('Missing session information.'));
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
        ]);

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
        session()->forget('social_user');

        return redirect()->route('student.home');
    }

    public function showUsernameForm()
    {
        if (!session('social_user')) {
            return redirect()->route('login');
        }

        $suggestedUsername = session('social_user')['username'];
        return view('auth.social-username', compact('suggestedUsername'));
    }

    protected function validateProvider(string $provider): void
    {
        if (!in_array($provider, self::ALLOWED_PROVIDERS)) {
            abort(404, __('Invalid provider.'));
        }
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
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        $avatarPath = $this->storeAvatar($newAvatarUrl);
        $user->avatar = $avatarPath;
        $user->save();
    }

    private function updateExistingUser(User $user, $socialUser, string $provider): void
    {
        $this->updateUserAvatar($user, $socialUser->getAvatar());
        $user->update([
            $provider . '_id' => $socialUser->getId(),
            'username' => $user->username ?? $socialUser->getNickname(),
        ]);
    }

    private function handleNewUser($socialUser, string $provider): RedirectResponse
    {
        $avatarPath = $this->storeAvatar($socialUser->getAvatar());
        session([
            'social_user' => [
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $avatarPath,
                'username' => $socialUser->getNickname(),
            ]
        ]);

        return redirect()->route('social.username');
    }

    private function redirectWithError(string $route, string $message): RedirectResponse
    {
        return redirect()->route($route)->withErrors(['error' => $message]);
    }
}
