@use('App\Enums\SchoolRequestStatus')
<div>
    @if (session('status'))
        <style>
            .toast-enter-active, .toast-leave-active {
                transition: opacity 0.5s ease, transform 0.5s ease;
            }

            .toast-enter, .toast-leave-to {
                opacity: 0;
                transform: translateY(-20px);
            }
        </style>
    @endif

    <!-- Toast -->
    @session('status')
    <div x-data="{ show: false, timeout: null }" x-init="

            show = true;
            timeout = setTimeout(() => show = false, 3000);

    " class="relative">
        <!-- Toast Notification -->
        <div x-show="show"
             x-transition:enter="toast-enter"
             x-transition:enter-start="toast-enter"
             x-transition:leave="toast-leave"
             x-transition:leave-end="toast-leave-to"
             class="fixed z-[100] top-5 right-5 bg-success-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-4"
             style="display: none;">
            <div>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                     color="#ffffff" fill="none">
                    <path
                        d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                        stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8 12.5L10.5 15L16 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                {!! session('status') !!} .
            </div>
            <button @click="show = false; clearTimeout(timeout)" class="text-white">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                     fill="none">
                    <path d="M19.0005 4.99988L5.00045 18.9999M5.00045 4.99988L19.0005 18.9999" stroke="currentColor"
                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
    @endif
    <!-- End Toast -->
    <!--====Start Body====-->
    <section>
        <!--Banner -->
        <div class="bg-background backdrop-blur-lg">
            <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto">
                <!-- Grid -->
                <div class="flex justify-center max-[835px]:flex-col">
                    <div class="flex items-center w-full min-[835px]:w-full">
                        <div class="grow">
                            <p class="text-2xl text-gray-800 font-semibold dark:text-neutral-200 mb-2">
                                {!! __('My requests') !!}
                            </p>
                            <p class="text-sm text-start md:text-base text-gray-800 dark:text-neutral-200 mb-2">
                                {!! __('Manage my requests') !!}
                            </p>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="text-center sm:text-start flex sm:justify-start sm:items-center gap-x-3 md:gap-x-4">
                        <a
                            style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
                            class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50"
                            href="{{ route('student.new-request') }}">
                            <svg
                                class="transition duration-75 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>

                            <span class="text-nowrap">
                               {!! __('New request') !!}
                            </span>

                        </a>

                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Grid -->
            </div>
        </div>
        <!-- End Banner -->
        <!--====== START BODY =======-->
        <!-- Announcement Banner -->
        <div class="bg-white/60 backdrop-blur-lg dark:bg-neutral-900/60">
            <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto">
                <!-- flex -->
                <div class="flex justify-center max-[835px]:flex-col">
                    <div class="flex items-center w-full min-[835px]:w-full min-[835px]:mb-2">

                        <!--  <div class="grow">
                          <p class="md:text-xs text-gray-800 font-semibold dark:text-neutral-500">
                              my requests in detail
                          </p>
                          <p class="text-sm md:text-base text-gray-800 dark:text-neutral-400">
                              Review and manage your new requests
                          </p>
                      </div>-->
                    </div>
                    <!-- End Col -->
                    <div class="flex justify-end w-full mb-2">
                        <!-- Select -->
                        <div>
                            <!-- Dropdown de filtre -->
                            <div x-data="{
                                isOpen: false,
                                selectedOption: @entangle('selectedFilter'),
                                options: {{ json_encode($filterOptions) }},
                                toggleDropdown() {
                                    this.isOpen = !this.isOpen;
                                },
                                selectOption(option) {
                                    this.selectedOption = option.value;
                                    $wire.setFilter(option.value);
                                    this.isOpen = false;
                                }
                            }">
                                <div x-on:click.outside="isOpen = false" class="relative">
                                    <div x-on:click="toggleDropdown()"
                                         x-bind:class="{ 'bg-white dark:bg-neutral-900': !isOpen }"
                                         class="hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                        <span class="inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                 height="24" class="mr-2">
                                                <path
                                                    d="M8.85746 12.5061C6.36901 10.6456 4.59564 8.59915 3.62734 7.44867C3.3276 7.09253 3.22938 6.8319 3.17033 6.3728C2.96811 4.8008 2.86701 4.0148 3.32795 3.5074C3.7889 3 4.60404 3 6.23433 3H17.7657C19.396 3 20.2111 3 20.672 3.5074C21.133 4.0148 21.0319 4.8008 20.8297 6.37281C20.7706 6.83191 20.6724 7.09254 20.3726 7.44867C19.403 8.60062 17.6261 10.6507 15.1326 12.5135C14.907 12.6821 14.7583 12.9567 14.7307 13.2614C14.4837 15.992 14.2559 17.4876 14.1141 18.2442C13.8853 19.4657 12.1532 20.2006 11.226 20.8563C10.6741 21.2466 10.0043 20.782 9.93278 20.1778C9.79643 19.0261 9.53961 16.6864 9.25927 13.2614C9.23409 12.9539 9.08486 12.6761 8.85746 12.5061Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>
                                            <span
                                                x-text="selectedOption ? options.find(o => o.value === selectedOption).label : '{{ __('Filter') }}'"></span>
                                        </span>
                                        <button type="button"></button>
                                    </div>

                                    <div x-show="isOpen"
                                         class="mt-2 absolute z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700">
                                        <template x-for="option in options" :key="option.value">
                                            <div x-on:click="selectOption(option)"
                                                 class="py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800">
                                                <div class="flex justify-between items-center w-full">
                                                    <span x-text="option.label"></span>
                                                    <span x-show="selectedOption === option.value"
                                                          class="hidden hs-selected:block">
                                                        <svg
                                                            class="flex-shrink-0 size-3.5 text-green-600 dark:text-green-500"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <!-- ... le reste de votre vue ... -->
                        </div>
                        <!-- End Select -->
                    </div>
                    <div class="w-full ml-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                                <svg wire:loading.remove.delay.default="1" wire:target="searchTerm"
                                     class="flex-shrink-0 size-4 text-gray-400 dark:text-white/60"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-gray-400 animate-spin fi-input-wrp-icon dark:text-gray-500"
                                     wire:loading.delay.default="" wire:target="searchTerm">
                                    <path clip-rule="evenodd"
                                          d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                          fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                          fill="currentColor">
                                    </path>
                                </svg>
                            </div>
                            <input wire:model.live.debounce="searchTerm"
                                   class="py-3 ps-10 pe-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                   type="search" placeholder="{!! __('Search') !!}">
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Grid -->
            </div>
        </div>
        <!-- End Announcement Banner -->
        <!-- Table Section -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
                            <!-- Header -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                        {!! __('Lists of requests') !!}
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        {!! __('Add Request, View and more.') !!}
                                    </p>
                                </div>


                            </div>
                            @if(!$searchTerm || !$requests->isEmpty())
                                @if($requests->isEmpty())
                                    <div class="p-6">
                                        <p class="text-gray-700 text-center dark:text-gray-300">Aucune requête
                                            disponible
                                            pour le
                                            moment.</p>
                                    </div>
                                @else
                                    <table
                                        class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">

                                        <thead class="divide-y divide-gray-200 dark:divide-white/5">

                                        <tr class="bg-gray-50 dark:bg-white/5">

                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
        <span class="text-sm font-semibold text-gray-950 dark:text-white">
            {{__('title')}}
        </span>

    </span>
                                            </th>
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
        <span class="text-sm font-semibold text-gray-950 dark:text-white">
           {{__('status')}}
        </span>

    </span>
                                            </th>
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
        <span class="text-sm font-semibold text-gray-950 dark:text-white">
           {{__('created at')}}
        </span>
    </span>
                                            </th>

                                            <th class="w-1"></th>

                                        </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                                        @foreach($requests as $request)
                                            <tr
                                                class="[@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5"
                                                wire:key="">


                                                <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3"
                                                    wire:key="{!! $request->id !!}.column.title">
                                                    <div class="">
                                                        <a
                                                            href="{{ route('student.request.details',$request->id) }}"
                                                            class="flex w-full disabled:pointer-events-none justify-start text-start">
                                                            <div class="grid w-full gap-y-1 px-3 py-4">

                                                                <div class="flex ">

                                                                    <div class="flex max-w-max">

                                                                        <div
                                                                            class="inline-flex items-center gap-1.5 ">

                                                                <span
                                                                    class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                    style="">{!! $request->title !!}</span>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </div>
                                                </td>

                                                <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3"
                                                    wire:key="{!! $request->id !!}.column.status">
                                                    <a href="{{ route('student.request.details',$request->id) }}"
                                                       class="flex w-full disabled:pointer-events-none justify-start text-start">
                                                        <div class="grid w-full gap-y-1 px-3 py-4">

                                                            <div class="flex gap-1.5 flex-wrap ">
                                                                {{--@dd(SchoolRequestStatus::Submitted->value)--}}
                                                                <div class="flex w-max">
                                                                    <div
                                                                        @php
                                                                            $status = SchoolRequestStatus::from($request->status);
                                                                            $styleVariables = match($request->status) {
                                                                        SchoolRequestStatus::Submitted->value => [
                                                                            '--c-400' => 'var(--info-400)',
                                                                            '--c-500' => 'var(--info-500)',
                                                                            '--c-600' => 'var(--info-600)',
                                                                            '--c-50'  => 'var(--info-50)',
                                                                        ],
                                                                        SchoolRequestStatus::Completed->value => [
                                                                            '--c-400' => 'var(--success-400)',
                                                                            '--c-500' => 'var(--success-500)',
                                                                            '--c-600' => 'var(--success-600)',
                                                                            '--c-50'  => 'var(--success-50)',
                                                                        ],
                                                                         SchoolRequestStatus::Draft->value => [
                                                                            '--c-400' => 'var(--warning-400)',
                                                                            '--c-500' => 'var(--warning-500)',
                                                                            '--c-600' => 'var(--warning-600)',
                                                                            '--c-50'  => 'var(--warning-50)',
                                                                        ],
                                                                        default => [],
                                                                    };

                                                                    $style = collect($styleVariables)->map(fn($value, $key) => "$key:$value")->implode(';');
                                                                        @endphp

                                                                        style="{{ $style }}"
                                                                        class="flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 bg-success-50 text-custom-500 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30">


                                                                <span class="grid">
                                                                    <span class="truncate capitalize">
                                                                        {!! $status->label() !!}
                                                                    </span>
                                                                </span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </a>
                                                </td>

                                                <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3"
                                                    wire:key="{!! $request->id !!}.column.created_at">
                                                    <div class="">
                                                        <a
                                                            href="{{ route('student.request.details',$request->id) }}"
                                                            class="flex w-full disabled:pointer-events-none justify-start text-start">
                                                            <div class="grid w-full gap-y-1 px-3 py-4">

                                                                <div class="flex ">

                                                                    <div class="flex max-w-max">

                                                                        <div
                                                                            class="inline-flex items-center gap-1.5 ">

                                                                    <span
                                                                        class="text-sm leading-6 text-gray-950 dark:text-white  "
                                                                        style="">
                                                                    {!! $request->created_at !!}
                                                                    </span>


                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </div>
                                                </td>

                                                <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                                    <div class="whitespace-nowrap px-3 py-4">
                                                        <div class="flex shrink-0 items-center gap-3 justify-end">

                                                            <div x-data="{ open: false }"
                                                                 class="relative inline-block text-left">
                                                                <div @click="open = !open" class="flex cursor-pointer">
                                                                    <button
                                                                        class="relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 -m-2 h-9 w-9 text-primary/50 hover:text-primary/80 focus-visible:ring-primary/600 dark:text-primary-400 dark:hover:text-primary/30 dark:focus-visible:ring-primary/50"
                                                                        type="button">
                                                                        <svg class="h-5 w-5"
                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                             viewBox="0 0 20 20" fill="currentColor"
                                                                             aria-hidden="true">
                                                                            <path
                                                                                d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                <div
                                                                    x-show="open"
                                                                    @click.away="open = false"
                                                                    x-transition:enter="transition ease-out duration-200"
                                                                    x-transition:enter-start="opacity-0 scale-95"
                                                                    x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="transition ease-in duration-75"
                                                                    x-transition:leave-start="opacity-100 scale-100"
                                                                    x-transition:leave-end="opacity-0 scale-95"
                                                                    @keydown.escape.window="open = false"
                                                                    @keydown.tab.prevent="$focus.wrap()"
                                                                    class="absolute right-[1rem] max-sm:translate-x-[1rem] z-10 w-screen divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10 max-w-[14rem]"
                                                                >

                                                                    <div class="p-1">
                                                                        <a
                                                                            href="{{ route('student.request.details',$request->id) }}"
                                                                            class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-info-500"
                                                                            type="button">
                                                                            <svg class="size-5"
                                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                                 viewBox="0 0 24 24" width="24"
                                                                                 height="24" fill="none">
                                                                                <path
                                                                                    d="M21.544 11.045C21.848 11.4713 22 11.6845 22 12C22 12.3155 21.848 12.5287 21.544 12.955C20.1779 14.8706 16.6892 19 12 19C7.31078 19 3.8221 14.8706 2.45604 12.955C2.15201 12.5287 2 12.3155 2 12C2 11.6845 2.15201 11.4713 2.45604 11.045C3.8221 9.12944 7.31078 5 12 5C16.6892 5 20.1779 9.12944 21.544 11.045Z"
                                                                                    stroke="currentColor"
                                                                                    stroke-width="1.5"/>
                                                                                <path
                                                                                    d="M15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12Z"
                                                                                    stroke="currentColor"
                                                                                    stroke-width="1.5"/>
                                                                            </svg>
                                                                            <span class="flex-1 truncate text-start">
                        {!! __('See') !!}
                    </span>
                                                                        </a>
                                                                        @if($request->status !== SchoolRequestStatus::Cancelled->value)

                                                                            <button type="button"
                                                                                    wire:click="cancelRequest({!! $request->id !!})"
                                                                                    wire:key="{!! $request->id !!}"
                                                                                    class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 text-primary-500 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                                                                <svg class="size-5"
                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                     viewBox="0 0 24 24" width="24"
                                                                                     height="24" fill="none">
                                                                                    <path
                                                                                        d="M19.0005 4.99988L5.00045 18.9999M5.00045 4.99988L19.0005 18.9999"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="1.5"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"/>
                                                                                </svg>
                                                                                <span
                                                                                    class="flex-1 truncate text-start">
                                                                                {!! __('Cancel') !!}
                                                                            </span>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                    <!-- End Table -->
                                @endif
                            @else
                                <div class="p-6">
                                    <p class="text-gray-700 text-center dark:text-gray-300">Aucun résultat trouvé pour
                                        <code
                                            class="text-foreground font-dm-sans font-extrabold">{{ $searchTerm }}</code>.
                                    </p>
                                </div>

                            @endif
                            <!-- Footer -->
                            <div
                                class="px-6 py-4 gap-3 flex justify-between items-center border-t border-gray-200 dark:border-neutral-700">

                                {{$requests->links('vendor.livewire.tailwind')}}
                            </div>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </section>
    <!--====End Body====-->

</div>
