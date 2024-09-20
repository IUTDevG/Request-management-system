@use('\App\Enums\RoleType')
<div>
    <header
        class="fixed top-0 z-50 flex flex-wrap w-full pb-2 text-sm border-b sm:justify-start sm:flex-col bg-background border-border sm:pb-0">
        <!-- Topbar -->
        <div class="max-w-[85rem] mx-auto w-full px-4 sm:px-6 lg:px-8 mt-2 flex items-center justify-end">
            <div class="flex items-center justify-end w-full py-2 gap-x-5 sm:pt-2 sm:pb-0">

                <div x-data="{
                    open: false,
                    toggle() {
                        this.open = !this.open
                    },
                    close() {
                        this.open = false
                    }
                }" x-on:keydown.escape.prevent.stop="close()"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
                    class="relative mt-2" x-on:mouseenter="open = true" x-on:mouseleave="close()">
                    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        class="inline-flex items-center justify-center gap-2 text-sm font-medium text-gray-600 hover:text-neutral-500 dark:text-neutral-400 dark:hover:text-neutral-300">
                        <svg x-show="theme === 'system'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            width="24" height="24" fill="none">
                            <path
                                d="M14 2H10C6.72077 2 5.08116 2 3.91891 2.81382C3.48891 3.1149 3.1149 3.48891 2.81382 3.91891C2 5.08116 2 6.72077 2 10C2 13.2792 2 14.9188 2.81382 16.0811C3.1149 16.5111 3.48891 16.8851 3.91891 17.1862C5.08116 18 6.72077 18 10 18H14C17.2792 18 18.9188 18 20.0811 17.1862C20.5111 16.8851 20.8851 16.5111 21.1862 16.0811C22 14.9188 22 13.2792 22 10C22 6.72077 22 5.08116 21.1862 3.91891C20.8851 3.48891 20.5111 3.1149 20.0811 2.81382C18.9188 2 17.2792 2 14 2Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M11 15H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M14.5 22L14.1845 21.5811C13.4733 20.6369 13.2969 19.1944 13.7468 18M9.5 22L9.8155 21.5811C10.5267 20.6369 10.7031 19.1944 10.2532 18"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M7 22H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            width="24" height="24" color="#000000" fill="none">
                            <path
                                d="M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path
                                d="M12 2V3.5M12 20.5V22M19.0708 19.0713L18.0101 18.0106M5.98926 5.98926L4.9286 4.9286M22 12H20.5M3.5 12H2M19.0713 4.92871L18.0106 5.98937M5.98975 18.0107L4.92909 19.0714"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>

                        <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            width="24" height="24" color="#ffffff" fill="none">
                            <path
                                d="M21.5 14.0784C20.3003 14.7189 18.9301 15.0821 17.4751 15.0821C12.7491 15.0821 8.91792 11.2509 8.91792 6.52485C8.91792 5.06986 9.28105 3.69968 9.92163 2.5C5.66765 3.49698 2.5 7.31513 2.5 11.8731C2.5 17.1899 6.8101 21.5 12.1269 21.5C16.6849 21.5 20.503 18.3324 21.5 14.0784Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="hidden md:block">
                            <span x-show="theme === 'dark'">{{ __('Dark') }}</span>
                            <span x-show="theme === 'light'">{{ __('Light') }}</span>
                            <span x-show="theme === 'system' && systemPrefersDark">{{ __('System') }}</span>
                            <span x-show="theme === 'system' && !systemPrefersDark">{{ __('System') }}</span>
                        </span>
                    </button>
                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                        class="text-gray-800 absolute dark:text-gray-400 transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms]  sm:w-48 z-10 bg-white sm:shadow-md rounded-lg p-2 dark:bg-neutral-800 sm:dark:border dark:border-neutral-700 dark:divide-neutral-700 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5">
                        <button data-value="default" @click="setTheme('light')"
                            class="flex rounded-[10px] p-1 hover:bg-gray-100 dark:hover:bg-gray-700 w-full">
                            <span
                                class="flex items-center justify-center flex-none w-6 h-6 rounded-md shadow ring-1 ring-slate-900/10">
                                <svg class="w-4 h-4 fill-slate-400">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7 1C7 0.447715 7.44772 0 8 0C8.55228 0 9 0.447715 9 1V2C9 2.55228 8.55228 3 8 3C7.44772 3 7 2.55228 7 2V1ZM11 8C11 9.65685 9.65685 11 8 11C6.34315 11 5 9.65685 5 8C5 6.34315 6.34315 5 8 5C9.65685 5 11 6.34315 11 8ZM13.6563 2.34285C13.2658 1.95232 12.6326 1.95232 12.2421 2.34285L11.535 3.04996C11.1445 3.44048 11.1445 4.07365 11.535 4.46417C11.9255 4.85469 12.5587 4.85469 12.9492 4.46417L13.6563 3.75706C14.0469 3.36654 14.0469 2.73337 13.6563 2.34285ZM12.242 13.6563L11.5349 12.9492C11.1443 12.5587 11.1443 11.9255 11.5349 11.535C11.9254 11.1445 12.5585 11.1445 12.9491 11.535L13.6562 12.2421C14.0467 12.6326 14.0467 13.2658 13.6562 13.6563C13.2656 14.0468 12.6325 14.0468 12.242 13.6563ZM16 7.99902C16 7.44674 15.5523 6.99902 15 6.99902H14C13.4477 6.99902 13 7.44674 13 7.99902C13 8.55131 13.4477 8.99902 14 8.99902H15C15.5523 8.99902 16 8.55131 16 7.99902ZM7 14C7 13.4477 7.44772 13 8 13C8.55228 13 9 13.4477 9 14V15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15V14ZM4.46492 11.5352C4.0744 11.1447 3.44123 11.1447 3.05071 11.5352L2.3436 12.2423C1.95307 12.6329 1.95307 13.266 2.3436 13.6566C2.73412 14.0471 3.36729 14.0471 3.75781 13.6566L4.46492 12.9494C4.85544 12.5589 4.85544 11.9258 4.46492 11.5352ZM4.46477 3.04973C4.85529 3.44025 4.85529 4.07342 4.46477 4.46394C4.07424 4.85447 3.44108 4.85447 3.05055 4.46394L2.34345 3.75684C1.95292 3.36631 1.95292 2.73315 2.34345 2.34262C2.73397 1.9521 3.36714 1.9521 3.75766 2.34262L4.46477 3.04973ZM3 8C3 7.44772 2.55228 7 2 7H1C0.447715 7 0 7.44772 0 8C0 8.55228 0.447715 9 1 9H2C2.55228 9 3 8.55228 3 8Z"
                                        fill="#38BDF8"></path>
                                </svg>
                            </span>
                            <span class="ml-3">{{ __('Light') }}</span>
                        </button>
                        <button data-value="dark" @click="setTheme('dark')"
                            class="flex rounded-[10px] p-1 hover:bg-gray-100 dark:hover:bg-gray-700 w-full">
                            <div
                                class="flex items-center justify-center flex-none w-6 h-6 rounded-md shadow ring-1 ring-slate-900/10">
                                <svg class="w-4 h-4 fill-slate-400">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.23 3.333C7.757 2.905 7.68 2 7 2a6 6 0 1 0 0 12c.68 0 .758-.905.23-1.332A5.989 5.989 0 0 1 5 8c0-1.885.87-3.568 2.23-4.668ZM12 5a1 1 0 0 1 1 1 1 1 0 0 0 1 1 1 1 0 1 1 0 2 1 1 0 0 0-1 1 1 1 0 1 1-2 0 1 1 0 0 0-1-1 1 1 0 1 1 0-2 1 1 0 0 0 1-1 1 1 0 0 1 1-1Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-3">Dark</div>
                        </button>
                        <button data-value="system" @click="setTheme('system')"
                            class="flex rounded-[10px] p-1 hover:bg-gray-100 dark:hover:bg-gray-700 w-full">
                            <div
                                class="flex items-center justify-center flex-none w-6 h-6 rounded-md shadow ring-1 ring-slate-900/10">
                                <svg class="w-4 h-4 fill-slate-400">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1 4a3 3 0 0 1 3-3h8a3 3 0 0 1 3 3v4a3 3 0 0 1-3 3h-1.5l.31 1.242c.084.333.36.573.63.808.091.08.182.158.264.24A1 1 0 0 1 11 15H5a1 1 0 0 1-.704-1.71c.082-.082.173-.16.264-.24.27-.235.546-.475.63-.808L5.5 11H4a3 3 0 0 1-3-3V4Zm3-1a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-3">{{ __('System') }}</div>
                        </button>
                    </div>
                </div>
                <livewire:settings.language-switcher />
                <a href="{{ \App\Services\UserRedirectService::getRedirectUrl()}}"
   class="inline-flex items-center px-3 py-2 text-sm font-semibold text-green-600 transition-colors duration-300 border border-green-600 rounded-lg gap-x-2 hover:bg-green-50 hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:text-green-500 dark:border-green-500 dark:hover:bg-green-900 dark:hover:text-green-400">
    {{ __('My requests') }}
</a>
            </div>
        </div>
        <!-- End Topbar -->

        <nav class="relative max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
            aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex items-center justify-center" href="{{ route('home') }}" aria-label="Brand"><img
                        src="{{ asset('images/Logo_IUT_Douala.png') }}" alt="Logo IUT"
                        class="h-20 mb-2">{{-- {{__('IUT REQUEST MANAGEMENT')}} --}}</a>
                <div class="sm:hidden">
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold hs-collapse-toggle size-9 text-foreground disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="flex-shrink-0 hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="flex-shrink-0 hidden hs-collapse-open:block size-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="navbar-collapse-with-animation"
                class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow sm:block">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end sm:ps-7">
                    <a class="py-3 font-medium text-gray-800 transition-colors ps-px sm:px-3 sm:py-6 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                        href="#home">{{ __('Home') }}</a>
                    <a class="py-3 font-medium text-gray-800 transition-colors ps-px sm:px-3 sm:py-6 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                        href="#about-us">{{ __('About') }}</a>
                    <a class="py-3 font-medium text-gray-800 transition-colors ps-px sm:px-3 sm:py-6 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                        href="#faq">{{ __('FAQ') }}</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->
    <main class="ml-0 mt-28">
        <!--Landing page-->
        <div id="home" class="max-w-[85rem] mx-auto w-full px-4 py-16 lg:flex lg:items-center">
            <div class="mb-8 lg:w-1/2 lg:mb-0">
                <h2 class="mb-4 text-3xl font-bold dark:text-white">{{ __('Simplify request management') }}</h2>
                <p class="mb-6 text-gray-700 dark:text-white">
                    {{ __('Our platform enables you to efficiently manage all your student requests, from enrolment applications to complaints and much more.') }}
                </p>
                <button id="watch-demo"
                    class="inline-flex items-center px-4 py-3 text-sm font-semibold transition-all duration-700 ease-in-out bg-green-500 border border-transparent rounded-lg text-nowrap gap-x-2 text-foreground hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none hover:scale-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                    </svg>
                    {{ __('How it works') }}
                </button>
            </div>
            <div class="lg:w-1/2">
                <img src="https://img.freepik.com/photos-gratuite/groupe-etude-du-peuple-africain_23-2149156373.jpg?t=st=1717942095~exp=1717945695~hmac=9c58c7fe0234a1f364367ef42d37206f8b70d80b85c02bf21def13e9d21d8c2d&w=996"
                    alt="Étudiants avec documents" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
        <!--==About us===-->
        <div id="about-us" class="max-w-[85rem] mx-auto w-full px-4 my-16 lg:flex lg:items-center lg:gap-8">
            <div class="mb-8 lg:w-1/2 lg:mb-0 lg:order-1">
                <img src="https://img.freepik.com/photos-gratuite/papier-pour-demande-hypotheque-table_23-2147764189.jpg?t=st=1717944906~exp=1717948506~hmac=477be1a3531dceb3279c581844b2cfbabde88e4b3374188554d21ad64ab7d702&w=996"
                    alt="Étudiants travaillant ensemble" class="w-full rounded-lg shadow-lg">
            </div>

            <div class="lg:w-1/2 lg:order-2">
                <h2 class="mb-4 text-3xl font-bold dark:text-white">{{ __('About the request management system') }}
                </h2>
                <p class="mb-6 text-gray-700 dark:text-white">
                    {{ __('Our innovative platform has been designed to simplify the management of requests from Douala IUT students. Whether for requests relating to grades, change of course or any other matter, our centralized system offers an efficient and and practical solution.') }}
                </p>
                <p class="mb-6 text-gray-700 dark:text-white">
                    {{ __('Thanks to an intuitive, user-friendly interface, students can can easily submit their requests and track their processing in real time. For their part, IUT have powerful tools at their disposal to manage, process and respond to these requests in an organized and transparent way.') }}
                </p>
            </div>
        </div>
        <div class="max-w-[85rem] px-4 my-16 sm:px-6 lg:px-8 lg:py-14 mx-auto" id="faq">
            <div class="grid gap-10 md:grid-cols-5">
                <div class="md:col-span-2">
                    <div class="max-w-xs">
                        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">
                            {{ __('Frequently-asked questions') }}</h2>
                        <p class="hidden mt-1 text-gray-600 md:block dark:text-neutral-400">
                            {{ __('Answers to the most frequently asked questions.') }}</p>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <div class="divide-y divide-gray-200 hs-accordion-group dark:divide-neutral-700">
                        <div class="pb-3 hs-accordion active"
                            id="hs-basic-with-title-and-arrow-stretched-heading-one">
                            <button
                                class="inline-flex items-center justify-between w-full pb-3 font-semibold text-gray-800 transition rounded-lg hs-accordion-toggle group gap-x-3 md:text-lg text-start hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                                {{ __('How do I submit a request?') }}
                                <!-- Icônes d'accordéon -->
                                <svg class="flex-shrink-0 block text-gray-600 hs-accordion-active:hidden size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="flex-shrink-0 hidden text-gray-600 hs-accordion-active:block size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-one"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                                <p class="text-gray-600 dark:text-neutral-400">
                                    {{ __('You can submit a request by logging into your student account, selecting the type of request and filling in the corresponding form.') }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-6 pb-3 hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-two">
                            <button
                                class="inline-flex items-center justify-between w-full pb-3 font-semibold text-gray-800 transition rounded-lg hs-accordion-toggle group gap-x-3 md:text-lg text-start hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                                {{ __('How long does it take to process a request?') }}
                                <!-- Icônes d'accordéon -->
                                <svg class="flex-shrink-0 block text-gray-600 hs-accordion-active:hidden size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="flex-shrink-0 hidden text-gray-600 hs-accordion-active:block size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-two"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                                <p class="text-gray-600 dark:text-neutral-400">
                                    {{ __('Processing times depend on the type and complexity of the request. However, we strive to process all requests as quickly as possible.') }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-6 pb-3 hs-accordion"
                            id="hs-basic-with-title-and-arrow-stretched-heading-three">
                            <button
                                class="inline-flex items-center justify-between w-full pb-3 font-semibold text-gray-800 transition rounded-lg hs-accordion-toggle group gap-x-3 md:text-lg text-start hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
                                {{ __('How do I track the status of a request?') }}
                                <!-- Icônes d'accordéon -->
                                <svg class="flex-shrink-0 block text-gray-600 hs-accordion-active:hidden size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="flex-shrink-0 hidden text-gray-600 hs-accordion-active:block size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-three"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
                                <p class="text-gray-600 dark:text-neutral-400">
                                    {{ __('You can track the status of your request by logging into your account and consulting the "My requests" section. You\'ll find updates and status for each request.') }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-6 pb-3 hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-four">
                            <button
                                class="inline-flex items-center justify-between w-full pb-3 font-semibold text-gray-800 transition rounded-lg hs-accordion-toggle group gap-x-3 md:text-lg text-start hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
                                {{ __('Can I cancel or modify a current request?') }}
                                <!-- Icônes d'accordéon -->
                                <svg class="flex-shrink-0 block text-gray-600 hs-accordion-active:hidden size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="flex-shrink-0 hidden text-gray-600 hs-accordion-active:block size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-four"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
                                <p class="text-gray-600 dark:text-neutral-400">
                                    {{ __('Yes, you can cancel or modify a current request as long as it has not yet been processed. Log in to your account and click on the corresponding button in the "My requests" section.') }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-6 pb-3 hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-five">
                            <button
                                class="inline-flex items-center justify-between w-full pb-3 font-semibold text-gray-800 transition rounded-lg hs-accordion-toggle group gap-x-3 md:text-lg text-start hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-five">
                                {{ __('What types of request are accepted?') }}
                                <!-- Icônes d'accordéon -->
                                <svg class="flex-shrink-0 block text-gray-600 hs-accordion-active:hidden size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="flex-shrink-0 hidden text-gray-600 hs-accordion-active:block size-5 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-five"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-five">
                                <p class="text-gray-600 dark:text-neutral-400">
                                    {{ __('Our system accepts several types of requests, including those related to grades, course changes, registrations, complaints, etc.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== FOOTER ========== -->
    <footer class="relative p-4 overflow-hidden shadow bg-background sm:p-6 xl:p-8 dark:border-neutral-700">
        <div class="max-w-[85rem] sm:flex sm:items-center sm:justify-center">
            <p class="mb-4 text-sm text-center text-gray-500 dark:text-gray-400 sm:mb-0">
                &copy; 2024-2025 <a href="https://jd-devs.com" class="transition-all hover:font-bold
                duration-300 text-success-500"
                    target="_blank">JD-DEVS</a>. {{ __('All rights reserved.') }}
            </p>
        </div>
    </footer>
</div>
