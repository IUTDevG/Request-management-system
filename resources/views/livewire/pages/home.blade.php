<div>

    <main class="ml-0 mt-20">
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
                    {{__('How it works')}} :{{app()->getLocale()}}
                </button>
            </div>
            <div class="lg:w-1/2">
                <img
                    src="https://img.freepik.com/photos-gratuite/groupe-etude-du-peuple-africain_23-2149156373.jpg?t=st=1717942095~exp=1717945695~hmac=9c58c7fe0234a1f364367ef42d37206f8b70d80b85c02bf21def13e9d21d8c2d&w=996"
                    alt="Étudiants avec documents" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
        <!--==About us===-->
        <div id="about-us" class="max-w-[85rem] mx-auto w-full px-4 my-16 lg:flex lg:items-center lg:gap-8">
            <div class="lg:w-1/2 mb-8  lg:mb-0 lg:order-1">
                <img
                    src="https://img.freepik.com/photos-gratuite/papier-pour-demande-hypotheque-table_23-2147764189.jpg?t=st=1717944906~exp=1717948506~hmac=477be1a3531dceb3279c581844b2cfbabde88e4b3374188554d21ad64ab7d702&w=996"
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
                            <button
                                class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                                {{__('How do I submit a request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg
                                    class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                <svg
                                    class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-one"
                                 class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                 aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('You can submit a request by logging into your student account, selecting the type of request and filling in the corresponding form.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-two">
                            <button
                                class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                                {{__('How long does it take to process a request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg
                                    class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                <svg
                                    class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-two"
                                 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                 aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('Processing times depend on the type and complexity of the request. However, we strive to process all requests as quickly as possible.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-three">
                            <button
                                class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
                                {{__('How do I track the status of a request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg
                                    class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                <svg
                                    class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-three"
                                 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                 aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('You can track the status of your request by logging into your account and consulting the "My requests" section. You\'ll find updates and status for each request.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-four">
                            <button
                                class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
                                {{__('Can I cancel or modify a current request?')}}
                                <!-- Icônes d'accordéon -->
                                <svg
                                    class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                <svg
                                    class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-four"
                                 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                 aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('Yes, you can cancel or modify a current request as long as it has not yet been processed. Log in to your account and click on the corresponding button in the "My requests" section.')}}</p>
                            </div>
                        </div>

                        <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-five">
                            <button
                                class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-400"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-five">
                                {{__('What types of request are accepted?')}}
                                <!-- Icônes d'accordéon -->
                                <svg
                                    class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                <svg
                                    class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-five"
                                 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                 aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-five">
                                <p class="text-gray-600 dark:text-neutral-400">{{__('Our system accepts several types of requests, including those related to grades, course changes, registrations, complaints, etc.')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
