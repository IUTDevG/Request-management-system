<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Filament\Events\Auth\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function loginSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($request);

        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider)
    {
        $this->validateProvider($request);

        $response = Socialite::driver($provider)->user();

        $email = $response->getEmail();
        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => "L'email n'a pas pu être récupéré depuis $provider."]);
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([$provider . '_id' => $response->getId()]);
            Auth::login($user, remember: true);
            return redirect()->route('student.home');
        }

        // Stocker les informations de l'utilisateur en session
        session([
            'social_user' => [
                'name' => $response->getName() ?? $response->getNickname() ?? $email,
                'email' => $email,
                'provider' => $provider,
                'provider_id' => $response->getId(),
            ]
        ]);

        // Rediriger vers un formulaire pour entrer le nom d'utilisateur
        return redirect()->route('social.username');
    }

    public function showUsernameForm()
    {
        if (!session('social_user')) {
            return redirect()->route('login');
        }

        return view('auth.social-username');
    }

    public function completeRegistration(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
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
        ]);

        event(new Registered($user));

        Auth::login($user, remember: true);

        // Nettoyer la session
        session()->forget('social_user');

        return redirect()->route('student.home');
    }

    protected function validateProvider(Request $request): array
    {
        return Validator::make(
            $request->route()->parameters(),
            ['provider' => 'in:google,github']
        )->validate();
    }
}
