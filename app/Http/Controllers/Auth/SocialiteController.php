<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    /**
     * The social providers that are allowed to be used.
     *
     * @var array
     */
    protected const ALLOWED_PROVIDERS = ['google', 'github'];

    /**
     * @param Request $request
     * @param string $provider
     * @return RedirectResponse
     */
    public function loginSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param Request $request
     * @param string $provider
     * @return RedirectResponse
     */
    public function callbackSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return $this->redirectWithError('login', __("An error occurred while connecting with :provider.", ['provider' => $provider]));
        }

        $email = $socialUser->getEmail();
        if (!$email) {
            return $this->redirectWithError('login', __("The email could not be retrieved from :provider.", ['provider' => $provider]));
        }

        $user = User::where('email', $email)->first();

        if ($user && !$user->hasRole(RoleType::STUDENT)) {
            Auth::login($user, true);
            return redirect()->to('admin');
        }
        if ($user && $user->hasRole('admin')) {
            $this->updateExistingUser($user, $socialUser, $provider);
            Auth::login($user, true);
            return redirect()->route('student.home');
        }

        $this->storeNewUserInSession($socialUser, $provider);
        return redirect()->route('social.complete');
    }

    protected function validateProvider(string $provider): void
    {
        if (!in_array($provider, self::ALLOWED_PROVIDERS)) {
            abort(404, __('Invalid provider.'));
        }
    }

    private function updateExistingUser(User $user, $socialUser, string $provider): void
    {
        $user->update([
            $provider . '_id' => $socialUser->getId(),
            'google_profile' => $socialUser->getAvatar(),
        ]);
    }

    private function storeNewUserInSession($socialUser, string $provider): void
    {
        $name = $socialUser->getName();
        $nameParts = explode(' ', $name);
        $firstName = $nameParts[0];
        $lastName = count($nameParts) > 1 ? end($nameParts) : '';
        $parts = explode('@', $socialUser->getEmail());

        $username = $this->generateUniqueUsername($provider === 'google' ? $parts[0] : $socialUser->getNickname());

        session([
            'social_user' => [
                'name' => $name,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'google_profile' => $socialUser->getAvatar(),
                'username' => $username,
            ]
        ]);
    }

    /**
     * @param string $base
     * @return string
     */
    private function generateUniqueUsername(string $base): string
    {
        $username = Str::slug($base);
        $originalUsername = $username;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * @param string $route
     * @param string $message
     * @return RedirectResponse
     */
    private function redirectWithError(string $route, string $message): RedirectResponse
    {
        return redirect()->route($route)->withErrors(['error' => $message]);
    }
}
