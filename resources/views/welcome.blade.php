<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="preload" href="{{asset('videos/video.mp4')}}" as="video">
        <link rel="preload" href="{{asset('css/video-overlay.css')}}" as="style">
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{asset('css/video-overlay.css')}}">
    </head>

    <body class="font-montserrat bg-background overflow-x-hidden">
    <!--===Loader===-->
    <x-preloader />
    <!--===End loader===-->
    <!-- ========== HEADER ========== -->
    <header class="flex fixed top-0 flex-wrap sm:justify-start sm:flex-col z-50 w-full bg-white border-b border-gray-200 text-sm pb-2 sm:pb-0 dark:bg-neutral-800 dark:border-neutral-700">
        <!-- Topbar -->
        <div class="max-w-[85rem] mx-auto w-full px-4 sm:px-6 lg:px-8 mt-2">
            <div class="flex items-center justify-end gap-x-5 w-full py-2 sm:pt-2 sm:pb-0">
                <div class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] ps-px sm:ps-3">
                    <a class="inline-flex justify-center items-center gap-2 font-medium text-gray-600 hover:text-neutral-500 text-sm dark:text-neutral-400 dark:hover:text-neutral-300"
                       href="#">
                        <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M21.54 15H17a2 2 0 0 0-2 2v4.54"/>
                            <path d="M7 3.34V5a3 3 0 0 0 3 3v0a2 2 0 0 1 2 2v0c0 1.1.9 2 2 2v0a2 2 0 0 0 2-2v0c0-1.1.9-2 2-2h3.17"/>
                            <path d="M11 21.95V18a2 2 0 0 0-2-2v0a2 2 0 0 1-2-2v-1a2 2 0 0 0-2-2H2.05"/>
                            <circle cx="12" cy="12" r="10"/>
                        </svg>
                        English
                    </a>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 hidden z-10 bg-white sm:shadow-md rounded-lg p-2 dark:bg-neutral-800 sm:dark:border dark:border-neutral-700 dark:divide-neutral-700 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5">
                        <button class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-green-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                href="#">
                            <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21.54 15H17a2 2 0 0 0-2 2v4.54"/>
                                <path d="M7 3.34V5a3 3 0 0 0 3 3v0a2 2 0 0 1 2 2v0c0 1.1.9 2 2 2v0a2 2 0 0 0 2-2v0c0-1.1.9-2 2-2h3.17"/>
                                <path d="M11 21.95V18a2 2 0 0 0-2-2v0a2 2 0 0 1-2-2v-1a2 2 0 0 0-2-2H2.05"/>
                                <circle cx="12" cy="12" r="10"/>
                            </svg>
                            English (US)
                        </button>
                        <button class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-green-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                href="#">
                            <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21.54 15H17a2 2 0 0 0-2 2v4.54"/>
                                <path d="M7 3.34V5a3 3 0 0 0 3 3v0a2 2 0 0 1 2 2v0c0 1.1.9 2 2 2v0a2 2 0 0 0 2-2v0c0-1.1.9-2 2-2h3.17"/>
                                <path d="M11 21.95V18a2 2 0 0 0-2-2v0a2 2 0 0 1-2-2v-1a2 2 0 0 0-2-2H2.05"/>
                                <circle cx="12" cy="12" r="10"/>
                            </svg>
                            French (FR)
                        </button>
                    </div>
                </div>
                <a class="px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-green-600 text-green-600 hover:border-green-500 hover:text-green-500 disabled:opacity-50 disabled:pointer-events-none dark:border-green-500 dark:text-green-500 dark:hover:text-green-400 dark:hover:border-green-400"
                   href="{{ route('student.home') }}">{{__('My request')}}</a>
            </div>
        </div>
        <!-- End Topbar -->

        <nav class="relative max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
             aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold dark:text-white" href="#" aria-label="Brand">{{__('IUT REQUEST MANAGEMENT')}}</a>
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
                       href="#home">HOME</a>
                    <a class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400 transition-colors"
                       href="#about-us">ABOUT</a>
                    <a class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-gray-800 hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400 transition-colors"
                       href="#faq">FAQ</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->
    <main class=" ml-0 mt-20">
        <!--Landing page-->
        <div id="home" class="max-w-[85rem] mx-auto w-full px-4 py-16 lg:flex lg:items-center">
            <div class="lg:w-1/2 mb-8 lg:mb-0">
                <h2 class="text-3xl font-bold mb-4 dark:text-white">{{__('Simplify request management')}}</h2>
                <p class="text-gray-700 mb-6 dark:text-white">{{__('Our platform enables you to efficiently manage all your student requests, from enrolment applications to complaints and much more.')}}</p>
                <button id="watch-demo"
                        class="py-3 px-4 inline-flex text-nowrap items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-500 text-foreground hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none hover:scale-100 transition duration-700 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/>
                    </svg>
                    {{__('How it works')}}
                </button>
            </div>
            <div class="lg:w-1/2">
                <img src="https://img.freepik.com/photos-gratuite/groupe-etude-du-peuple-africain_23-2149156373.jpg?t=st=1717942095~exp=1717945695~hmac=9c58c7fe0234a1f364367ef42d37206f8b70d80b85c02bf21def13e9d21d8c2d&w=996"
                     alt="Étudiants avec documents" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
        <!--==About us===-->
        <div id="about-us" class="max-w-[85rem] mx-auto w-full px-4 my-16 lg:flex lg:items-center lg:gap-8">
            <div class="lg:w-1/2 mb-8  lg:mb-0 lg:order-1">
                <img src="https://img.freepik.com/photos-gratuite/papier-pour-demande-hypotheque-table_23-2147764189.jpg?t=st=1717944906~exp=1717948506~hmac=477be1a3531dceb3279c581844b2cfbabde88e4b3374188554d21ad64ab7d702&w=996"
                     alt="Étudiants travaillant ensemble" class="w-full rounded-lg shadow-lg">
            </div>

            <div class="lg:w-1/2 lg:order-2">
                <h2 class="text-3xl font-bold mb-4 dark:text-white">{{__('About the request management system')}}</h2>
                <p class="text-gray-700 mb-6 dark:text-white">{{__('Our innovative platform has been designed to simplify the management of requests from Douala IUT students. Whether for requests relating to grades, change of course or any other matter, our centralized system offers an efficient and and practical solution.')}}</p>
                <p class="text-gray-700 mb-6 dark:text-white">{{__('Thanks to an intuitive, user-friendly interface, students can can easily submit their requests and track their processing in real time. For their part, IUT have powerful tools at their disposal to manage, process and respond to these requests in an organized and transparent way.')}}</p>
            </div>
        </div>
        <div class="max-w-[85rem] px-4 my-16 sm:px-6 lg:px-8 lg:py-14 mx-auto" id="faq">
            <div class="grid md:grid-cols-5 gap-10">
                <div class="md:col-span-2">
                    <div class="max-w-xs">
                        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{__('Frequently-asked questions')}}</h2>
                        <p class="mt-1 hidden md:block text-gray-600 dark:text-neutral-400">{{__('Answers to the most frequently asked questions.')}}</p>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <div class="hs-accordion-group divide-y divide-gray-200 dark:divide-neutral-700">
                        <div class="hs-accordion pb-3 active" id="hs-basic-with-title-and-arrow-stretched-heading-one">
                            <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                                {{__('How do I submit a request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('You can submit a request by logging into your student account, selecting the type of request and filling in the corresponding form.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-two">
                            <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                                {{__('How long does it take to process a request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('Processing times depend on the type and complexity of the request. However, we strive to process all requests as quickly as possible.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-three">
                            <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
                                {{__('How do I track the status of a request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('You can track the status of your request by logging into your account and consulting the "My requests" section. You\'ll find updates and status for each request.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-four">
                            <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
                                {{__('Can I cancel or modify a current request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-four" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('Yes, you can cancel or modify a current request as long as it has not yet been processed. Log in to your account and click on the corresponding button in the "My requests" section.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-five">
                            <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-five">
                                {{__('What types of request are accepted?')}}
                                <!-- Icônes d'accordéon -->
                                <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-five" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-five">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('Our system accepts several types of requests, including those related to grades, course changes, registrations, complaints, etc.')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== FOOTER ========== -->
    <footer class="relative  overflow-hidden bg-white shadow  p-4 sm:p-6 xl:p-8 dark:bg-neutral-800 dark:border-neutral-700 antialiased">
        <div class="max-w-[85rem] sm:flex sm:items-center sm:justify-between">
            <p class="mb-4 text-sm text-center text-gray-500 dark:text-gray-400 sm:mb-0">
                &copy; 2024-2025 <a href="#" class="hover:underline" target="_blank">IUT</a>. {{__('All rights reserved.')}}
            </p>
            <div class="flex justify-center items-center space-x-1">
                <div class="hs-tooltip">
                    <a href="#"
                       class="hs-tooltip-toggle inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                  d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Facebook</span>
                    </a>
                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Like us on Facebook
        </span>
                </div>
                <div class="hs-tooltip">
                    <a href="#"
                       class="hs-tooltip-toggle inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 20 20">
                            <path fill="currentColor"
                                  d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z"/>
                        </svg>
                        <span class="sr-only">X</span>
                    </a>
                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Like us on X
        </span>
                </div>
                <div class="hs-tooltip">
                    <a href="#"
                       class="hs-tooltip-toggle inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">GitHub</span>
                    </a>
                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Like us on GitHub
        </span>
                </div>
            </div>
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->
    <div id="video-overlay" class="video-overlay">
        <div class="video-container">
            <span id="close-button" class="close-button">&times;</span>
            <video id="demo-video" class="max-w-full h-auto" controls>
                <source src="{{asset('videos/video.mp4')}}" type="video/mp4">
                Votre navigateur ne prend pas en charge la balise vidéo.
            </video>
        </div>
    </div>
    <!--===Script section===-->
    <script src="{{asset('js/darkMode.js')}}"></script>
    <script src="{{asset('js/anchor.js')}}"></script>

    <script>
        const watchDemoButton = document.getElementById('watch-demo');
        const videoOverlay = document.getElementById('video-overlay');
        const demoVideo = document.getElementById('demo-video');
        const closeButton = document.getElementById('close-button');

        watchDemoButton.addEventListener('click', () => {
            videoOverlay.classList.add('show');
        });

        videoOverlay.addEventListener('click', (event) => {
            if (event.target === videoOverlay || event.target === closeButton) {
                videoOverlay.classList.remove('show');
                demoVideo.pause();
            }
        });
    </script>
    </body>
</html>
