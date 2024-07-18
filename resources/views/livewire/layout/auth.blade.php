<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    @vite(['resources/css/app.css','resources/js/app.js'])--}}
    <link rel="stylesheet" href="{{asset('assets/app.css')}}">
    <script src="{{asset('assets/app.js')}}"></script>
    <title>Sign-up page</title>
</head>
<body class="font-montserrat">

<!-- ========== HEADER ========== -->
<header
    class="flex fixed top-0 flex-wrap sm:justify-start sm:flex-col z-50 w-full bg-background border-b border-border text-sm pb-2 sm:pb-0">
    <nav class="relative max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
         aria-label="Global">
        <div class="flex items-center justify-between">
            <a class="flex-none text-xl font-semibold dark:text-white" href="{{ route('home') }}"
               aria-label="Brand">{{__('IUT REQUEST MANAGEMENT')}}</a>
            <div class="sm:hidden">
                <button type="button"
                        class="hs-collapse-toggle size-9 flex justify-center items-center text-sm font-semibold text-foreground disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                    <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6"/>
                        <line x1="3" x2="21" y1="12" y2="12"/>
                        <line x1="3" x2="21" y1="18" y2="18"/>
                    </svg>
                    <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/>
                        <path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div id="navbar-collapse-with-animation"
             class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end sm:ps-7">
                <a class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400 transition-colors"
                   href="{{ route('home') }}#home">{{__('Home')}}</a>
                <a class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400 transition-colors"
                   href="{{ route('home') }}#about-us">{{__('About')}}</a>
                <a class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400 transition-colors"
                   href="{{ route('home') }}#faq">{{__('FAQ')}}</a>
            </div>
        </div>
    </nav>
</header>
<!-- ========== END HEADER ========== -->
<main class="max-lg:ml-0 max-lg:mt-20 flex">
    <!-- Left Pane -->
    <div class="hidden lg:flex items-center justify-center flex-1">
        <div class="w-full text-center">
            <img src="{{asset('images/login.jpg')}}" class="w-full h-full object-cover" alt="login image">
        </div>
    </div>
    <!-- Right Pane -->

    <div class="w-full lg:w-1/2 flex items-center justify-center max-lg:px-5">
        {{ $slot }}
    </div>
</main>

<!-- ========== FOOTER ========== -->
<footer class="relative bg-background overflow-hidden shadow  p-4 sm:p-6 xl:p-8 dark:border-neutral-700">
    <div class="max-w-[85rem] sm:flex sm:items-center sm:justify-center">
        <p class="mb-4 text-sm text-center text-gray-500 dark:text-gray-400 sm:mb-0">
            &copy; 2024-2025 <a href="https://iut-dla.com" class="hover:underline text-success-500" target="_blank">IUT</a>. {{__('All rights reserved.')}}
        </p>
    </div>
</footer>
<!-- ========== END FOOTER ========== -->
</body>
</html>
