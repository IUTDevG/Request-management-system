<div class="max-w-md w-full p-6 text-foreground">
    <!--<div class="flex justify-center">
        <img src="assets/images/logo.png" class="size-12" alt="logo">
    </div>-->
    <h1 class="text-4xl font-extrabold text-green-500 mb-6 text-center">{{__('Reset Password')}}</h1>
    <h1 class="text-sm font-semibold mb-6 text-center">{{__('Fill in the form to reset your password')}}</h1>

    <form wire:submit='resetPassword' method="POST" class="space-y-4">

        @session('success')
        <div class="bg-green-400 text-center text-sm text-white rounded-lg p-4 mt-4" role="alert">
            {{session('success')}}
        </div>
        @endsession
        @session('status')
        <div class="bg-red-500 text-center text-sm text-white rounded-lg p-4 my-4" role="alert">
            {{session('status')}}
        </div>
        @endsession
        @session('email')
        <div class="bg-red-500 text-center text-sm text-white rounded-lg p-4 my-4" role="alert">
            {{session('email')}}
        </div>
        @endsession

        <div>
            <x-label for="password">{{__('Password')}}</x-label>
            <x-input :is-password="true" type="password" id="password" name="password" wire:model.live='password'/>
            <x-input-error for='password'></x-input-error>
        </div>
        <div>
            <x-label for="password_confirmation">{{__('Password confirmation')}}</x-label>
            <x-input :is-password="true" type="password" id="password_confirmation" name="password_confirmation"
                     wire:model.live='password_confirmation'/>
            <x-input-error for='password_confirmation'></x-input-error>
        </div>
        <div>
            <button type="submit"
                    class="w-full font-semibold rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none p-2 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                {{__('Save')}}
            </button>
        </div>
    </form>
</div>
