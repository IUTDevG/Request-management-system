<div class="max-w-md w-full p-6 text-foreground">
        <!--<div class="flex justify-center">
            <img src="assets/images/logo.png" class="size-12" alt="logo">
        </div>-->
        <h1 class="text-4xl font-extrabold text-green-500 mb-6 text-center">{{__('Password forgot')}}</h1>
        <h1 class="text-sm font-semibold mb-6 text-center">{{__('Fill in the form if you have forgotten your password')}}</h1>
        @session('status')
        <div class="bg-blue-600 text-center text-sm text-dark rounded-lg p-4 mt-4" role="alert">
            {{session('status')}}
        </div>
        @endsession

        <form wire:submit.prevent='sendResetLink' method="POST" class="space-y-4">
            <!-- Your form elements go here -->
            <div>
                <x-label for="email">{{__('Email')}}</x-label>
                <x-input placeholder="{{__('Enter your email address here')}}" wire:model="email" type="email" id="email" name="email" />
                <x-input-error for='email'></x-input-error>
            </div>

            <div>
                <button type="submit" class="w-full font-semibold rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none p-2 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">{{__('Reset Password')}}</button>
            </div>
        </form>
        <div class="mt-4 text-sm text-gray-400 text-center">
            <p>{{__('Don\'t have an account?')}} <a href="{{route('register')}}" class="text-foreground hover:underline">{{__('register')}}</a>
            </p>
        </div>
    </div>
