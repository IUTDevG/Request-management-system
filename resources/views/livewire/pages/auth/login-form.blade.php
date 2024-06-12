
    {{-- The Master doesn't talk, he acts. --}}
    <div class="w-full bg-background lg:w-1/2 flex items-center justify-center">
        <div class="max-w-md w-full p-6">
            <!--<div class="flex justify-center">
                <img src="assets/images/logo.png" class="size-12" alt="logo">
            </div>-->
            <h1 class="text-4xl font-extrabold text-green-500 mb-6 text-center">Welcome Back</h1>
            <h1 class="text-sm font-semibold mb-6 text-center">Join to Our Community with all time access and free </h1>

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
        <div class="bg-blue-600 text-center text-sm text-dark rounded-lg p-4 mt-4" role="alert">
            {{session('status')}}
        </div>
        @endsession
            <form wire:submit.prevent="submitForm" method="POST" class="space-y-4">
                <!-- Your form elements go here -->
                <div>
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="text" id="email" name="email" wire:model="email"
                           class="mt-1 p-2 w-full border rounded-md focus:border-b-current bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    <x-input-error for="email"></x-input-error>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input type="password" id="password" name="password" wire:model="password"
                           class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    <x-input-error for="password"></x-input-error>

                </div>
                <div class="flex items-center justify-between gap-2 mt-5">
                    <div class="flex items-center">
                        <input id="remember" wire:model="remember" name="remember" type="checkbox" class="shrink-0 mt-0.5 rounded text-green-600 focus:ring-green-500 border-green-700 checked:bg-green-500 checked:border-green-500 focus:ring-offset-green-800" />
                        <label for="remember" class="ml-3 block text-sm">
                            Remember me
                        </label>
                    </div>
                    <div>
                        <a href="{{route('forgot-password')}}" class="font-semibold text-sm hover:underline">
                            Forgot Password?
                        </a>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none p-2 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Sign In</button>
                </div>
            </form>
            <div class="mt-4 text-sm text-gray-400 text-center">
                <p>Don't have an account? <a href="{{route('register')}}" class="text-black hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>
