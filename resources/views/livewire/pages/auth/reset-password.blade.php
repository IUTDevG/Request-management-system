<div class="w-full bg-background lg:w-1/2 flex items-center justify-center">
    <div class="max-w-md w-full p-6">
        <!--<div class="flex justify-center">
            <img src="assets/images/logo.png" class="size-12" alt="logo">
        </div>-->
        <h1 class="text-4xl font-extrabold text-green-500 mb-6 text-center">Reset Password</h1>
        <h1 class="text-sm font-semibold mb-6 text-center">Fill in the form to reset your password</h1>

        <form wire:submit.prevent='resetPassword' method="POST" class="space-y-4">

            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" wire:model='password'
                       class="mt-1 p-2 w-full border rounded-md focus:border-green-600 focus:ring-green-600 bg-background focus:outline-none focus:ring-2 transition-colors duration-300">
                       <x-input-error for='password'></x-input-error>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium">Password confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation" wire:model='password_confirmation'
                       class="mt-1 p-2 w-full border rounded-md focus:border-green-600 focus:ring-green-600 bg-background focus:outline-none focus:ring-2 transition-colors duration-300">
                       <x-input-error for='password_confirmation'></x-input-error>
            </div>
            <div>
                <button type="submit"
                        class="w-full font-semibold rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none p-2 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                    Reset Password
                </button>
            </div>
        </form>
        <div class="mt-4 text-sm text-gray-400 text-center">
            <p>Don't have an account? <a href="{{route('register')}}" class="text-white hover:underline">Sign up</a>
            </p>
        </div>
    </div>
</div>
