{{-- The Master doesn't talk, he acts. --}}
    <div class="max-w-md w-full space-y-4">
        <h1 class="text-4xl font-extrabold text-green-500 mb-6 text-center font-heading">{{__('Welcome Back')}}</h1>
        <h3 class="text-sm font-semibold mb-6 text-center font-heading">{{__('Welcome to the IUT Douala requests portal. Log in to access your services.')}}</h3>

        @session('success')
        <div class="bg-green-400 text-center text-sm text-white rounded-lg p-4 mt-4" role="alert">
            {{session('success')}}
        </div>
        @endsession
        @session('error')
        <div class="bg-red-500 text-center text-sm text-white rounded-lg p-4 my-4" role="alert">
            {{session('error')}}
        </div>
        @endsession

        @session('status')
        <div class="rounded-md bg-green-50 p-4 mb-5">
            <div class="flex inherit">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                              clip-rule="evenodd"></path>
                    </svg>
                    {{session('status')}}
                </div>
            </div>
        </div>
        @endsession
        <form wire:submit.prevent="submitForm" method="POST" class="space-y-4">
            <!-- Your form elements go here -->
            <div>
                <label for="email" class="block text-sm font-medium uppercase">{{__('Email')}}</label>
                <input type="text" id="email" name="email" wire:model="email"
                       class="mt-1 p-2 w-full border rounded-md focus:border-b-current bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                <x-input-error for="email"></x-input-error>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">{{__('Password')}}</label>
                <input type="password" id="password" name="password" wire:model="password"
                       class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                <x-input-error for="password"></x-input-error>

            </div>
            <div class="flex items-center justify-between gap-2 mt-5">
                <div class="flex items-center">
                    <input id="remember" wire:model="remember" name="remember" type="checkbox"
                           class="shrink-0 mt-0.5 rounded text-green-600 focus:ring-green-500 border-green-700 checked:bg-green-500 checked:border-green-500 focus:ring-offset-green-800"/>
                    <label for="remember" class="ml-1 block text-sm text-nowrap">
                        {{__('Remember me')}}
                    </label>
                </div>
                <div>
                    <a href="{{route('student.forgot-password')}}" class="font-semibold text-sm hover:underline text-nowrap">
                        {{__('Forgot your password?')}}
                    </a>
                </div>
            </div>
            <div>
                <button type="submit"
                        class="w-full font-semibold rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none p-2 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                    <span wire:loading.remove>{{__('Login')}}</span><span
                        wire:loading>{{__('We check your information...')}}</span></button>
            </div>
        </form>
        <div class="mt-4 text-sm text-gray-400 text-center">
            <p>{{__('Don\'t have an account?')}} <a href="{{route('register')}}"
                                                    class="text-black hover:underline">{{__('register')}}</a>
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
                    <a href=""
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
                    <a href=""
                       class="button inline-flex justify-center py-2 px-4 border border-border rounded-md shadow-sm bg-blend-color text-sm hover:bg-popover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-body focus:ring-green-500 w-full font-normal">
                        <span class="sr-only">Continuer avec Google</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" aria-hidden="true"
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
