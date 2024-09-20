<div class="max-w-md w-full space-y-4 text-foreground">
    <!--  <div class="flex justify-center">
          <img src="assets/images/logo.png" class="size-12" alt="logo">
      </div>-->
    <h1 class="text-4xl font-extrabold mb-6 text-green-500 text-center">{{__('Register')}}</h1>
    <h1 class="text-sm font-semibold mb-6 text-center">{{__('Welcome to the IUT Douala requests portal. Log in to access your services.')}}</h1>

    <form wire:submit.prevent="submitForm" class="space-y-4">
        <!-- Your form elements go here -->
        <div>
            <x-label for="name">{{__("Name")}}</x-label>
            <x-input type="text" id="name" name="name" wire:model="name"/>
            <x-input-error for="name"></x-input-error>
        </div>
        <div>
            <x-label for="matricule" >{{__("Matricule")}}</x-label>
            <x-input type="text" id="matricule" name="matricule" wire:model="matricule"/>
            <x-input-error for="matricule"></x-input-error>
        </div>
        <div>
            <x-label for="email">{{__("Email")}}</x-label>
            <x-input type="email" id="email" name="email" wire:model="email"/>
            <x-input-error for="email"></x-input-error>
        </div>
        <div>
            <x-label for="password">{{__('Password')}}</x-label>
            <x-input :is-password="true" type="password" id="password" name="password" wire:model="password"/>
            <x-input-error for="password"></x-input-error>
        </div>
        <div>
            <x-label for="password_confirmation">{{__("Password confirmation")}}</x-label>
            <x-input :is-password="true" type="password" id="password_confirmation" name="password_confirmation"
                   wire:model="password_confirmation"/>
            <x-input-error for="password_confirmation"></x-input-error>
        </div>
        <div>
            <button type="submit"
                    class="w-full font-semibold rounded-lg border border-transparent bg-green-500  text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none p-2 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                {{__("register")}}
            </button>
        </div>
    </form>
    <div class="mt-4 text-sm text-gray-400 text-center">
        <p>{{__('Already registered?')}} <a href="{{route('login')}}"
                                            class="text-foreground font-normal hover:underline">{{__('Login')}}</a>
        </p>
    </div>
    <div>
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-skin-base"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-background text-foreground font-normal">
                Ou continuer avec
                </span>
            </div>
        </div>
        <div class="mt-6 space-y-2">
            <div>
                <a href="{{ route('socialite.auth','github') }}" target="_blank" rel="noopener noreferrer"
                   class="button inline-flex justify-center py-2 px-4 border border-border rounded-md shadow-sm bg-blend-color text-sm hover:bg-popover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-body focus:ring-green-500 w-full font-normal">
                    <span class="sr-only">Continuer avec Github</span>
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                              clip-rule="evenodd"></path>
                    </svg>
                    Github
                </a>
            </div>
            <div>
                <a href="{{ route('socialite.auth','google') }}" target="_blank" rel="noopener noreferrer"
                   class="button inline-flex justify-center py-2 px-4 border border-border rounded-md shadow-sm bg-blend-color text-sm hover:bg-popover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-body focus:ring-green-500 w-full font-normal">
                    <span class="sr-only">Continuer avec Google</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="currentColor"
                         aria-hidden="true"
                         preserveAspectRatio="xMidYMid" viewBox="0 0 256 262" id="google">
                        <path fill="#4285F4"
                              d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                        <path fill="#34A853"
                              d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                        <path fill="#FBBC05"
                              d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                        <path fill="#EB4335"
                              d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
                    </svg>
                    Google
                </a>
            </div>
        </div>
    </div>
</div>
