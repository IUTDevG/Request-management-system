
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="w-full bg-background lg:w-1/2 flex items-center justify-center">
        <div class="max-w-md w-full p-6">
            <!--  <div class="flex justify-center">
                  <img src="assets/images/logo.png" class="size-12" alt="logo">
              </div>-->
            <h1 class="text-4xl font-extrabold mb-6 text-green-500 text-center">Sign Up</h1>
            <h1 class="text-sm font-semibold mb-6 text-center">Welcome to the iut request management platform</h1>

            <form wire:submit.prevent="submitForm" class="space-y-4">
                <!-- Your form elements go here -->
                <div>
                    <label for="name" class="block text-sm font-medium">{{__("Votre nom")}}</label>
                    <input type="text" id="name" name="name" wire:model="name"
                           class="mt-1 p-2 w-full border rounded-md focus:border-b-current bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    <x-input-error for="name"></x-input-error>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium">{{__("Nom d'utilisateur")}}</label>
                    <input type="text" id="username" name="username" wire:model="username"
                           class="mt-1 p-2 w-full border rounded-md focus:border-b-current bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    <x-input-error for="user_name"></x-input-error>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium">{{__("Email")}}</label>
                    <input type="text" id="email" name="email" wire:model="email"
                           class="mt-1 p-2 w-full border rounded-md focus:border-b-current bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    <x-input-error for="email"></x-input-error>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">{{__('Mot de passe')}}</label>
                    <input type="password" id="password" name="password" wire:model="password"
                           class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    <x-input-error for="password"></x-input-error>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">{{__("Password confirmation")}}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" wire:model="password_confirmation"
                           class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    <x-input-error for="password_confirmation"></x-input-error>
                </div>
                <div>
                    <button type="submit"
                            class="w-full font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none p-2 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                        {{__("Sign up")}}
                    </button>
                </div>
            </form>
            <div class="mt-4 text-sm text-gray-400 text-center">
                <p>Already have an account? <a href={{route('login')}} class="text-black hover:underline">Sign in</a>
                </p>
            </div>
        </div>
    </div>

