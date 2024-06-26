@use('App\Enums\SchoolRequestStatus')
<div>


    <!-- Toast -->
    @session('status')

    <x-status> {!! session('status') !!} .</x-status>

    @endsession
    <!-- End Toast -->
    <!--====Start Body====-->
    <section>
        <!--Banner -->
        <div>
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
        <div>
            <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto">
                <!-- flex -->
                <div class="flex justify-center max-[835px]:flex-col">
                    <div class="flex items-center w-full min-[835px]:w-full min-[835px]:mb-2">

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
                        }" class="relative inline-block text-left">
                                <div>
                                    <button type="button" @click="toggleDropdown" @keydown.escape.window="isOpen = false"
                                            x-bind:class="{ 'bg-white dark:bg-neutral-900 text-gray-800 font-semibold dark:text-neutral-200': isOpen }"
                                            class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500 transition-colors duration-200"
                                            aria-haspopup="true" :aria-expanded="isOpen">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" />
                                            </svg>
                                            <span x-text="selectedOption ? options.find(o => o.value === selectedOption).label : '{{ __('Filter') }}'"></span>
                                        </span>
                                        <svg class="-mr-1 ml-2 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <div x-show="isOpen" @click.away="isOpen = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                                     role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                    <div class="py-1" role="none">
                                        <template x-for="option in options" :key="option.value">
                                            <button @click="selectOption(option)"
                                                    class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-900 transition-colors duration-200"
                                                    role="menuitem">
                                                <span class="flex-grow" x-text="option.label"></span>
                                                <svg x-show="selectedOption === option.value"
                                                     class="h-5 w-5 text-indigo-600"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
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
                                     class="w-5 h-5 text-gray-400 animate-spin dark:text-gray-500"
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
                                                <span
                                                    class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                                                        {{__('title')}}
                                                    </span>

                                                </span>
                                            </th>
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                                <span
                                                    class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                                                       {{__('status')}}
                                                    </span>

                                                </span>
                                            </th>
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                                <span
                                                    class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
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
                                                                        SchoolRequestStatus::Cancelled->value => [
                                                                             '--c-400' => 'var(--danger-400)',
                                                                            '--c-500' => 'var(--danger-500)',
                                                                            '--c-600' => 'var(--danger-600)',
                                                                            '--c-50'  => 'var(--danger-50)',
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
                                                                    x-transition:leave="transition ease-in duration-150"
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
                                                                                    wire:click="openCancelModal({!! $request->id !!})"
                                                                                    wire:key="{!! $request->id !!}"
                                                                                    class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 text-primary-500 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                                                                <svg class="size-5" wire:loading.remove
                                                                                     wire:target="openCancelModal"
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
                                                                                <svg fill="none" viewBox="0 0 24 24"
                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                     class="w-5 h-5 text-primary-400 animate-spin dark:text-primary-500"
                                                                                     wire:loading.delay.default=""
                                                                                     wire:target="openCancelModal">
                                                                                    <path clip-rule="evenodd"
                                                                                          d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                                                          fill-rule="evenodd"
                                                                                          fill="currentColor"
                                                                                          opacity="0.2"></path>
                                                                                    <path
                                                                                        d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                                                                        fill="currentColor">
                                                                                    </path>
                                                                                </svg>
                                                                                <span
                                                                                    class="flex-1 truncate text-start">
                                                                                {!! __('Cancel') !!}
                                                                            </span>
                                                                            </button>
                                                                            @if($showCancelModal)
                                                                                <div
                                                                                    x-data="{ show: @entangle('showCancelModal'), loaded: false }"
                                                                                    x-init="
                                                                                        $nextTick(() => { loaded = true; });
                                                                                        Livewire.hook('message.processed', (message, component) => {
                                                                                            if (component.id === $wire.__instance.id) {
                                                                                                $nextTick(() => Alpine.initTree(document.body));
                                                                                            }
                                                                                        })
                                                                                    "
                                                                                    x-show="show && loaded"
                                                                                    x-cloak
                                                                                    :class="{ 'hidden': !show }"
                                                                                    x-transition:enter="transition ease-out duration-300"
                                                                                    x-transition:enter-start="opacity-0 scale-90"
                                                                                    x-transition:enter-end="opacity-100 scale-100"
                                                                                    x-transition:leave="transition ease-in duration-300"
                                                                                    x-transition:leave-start="opacity-100 scale-100"
                                                                                    x-transition:leave-end="opacity-0 scale-90"
                                                                                    class="fixed z-50 inset-0 overflow-y-auto"
                                                                                    aria-labelledby="modal-title"
                                                                                    role="dialog"
                                                                                    aria-modal="true">
                                                                                    <div
                                                                                        class="flex items-center justify-center overflow-hidden  h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                                                        <div
                                                                                            x-show="show"
                                                                                            x-transition:enter="ease-out duration-300"
                                                                                            x-transition:enter-start="opacity-0"
                                                                                            x-transition:enter-end="opacity-100"
                                                                                            x-transition:leave="ease-in duration-200"
                                                                                            x-transition:leave-start="opacity-100"
                                                                                            x-transition:leave-end="opacity-0"
                                                                                            class="fixed h-screen inset-0 backdrop-blur-[2px] bg-white/10 bg-opacity-50 transition-opacity"
                                                                                            aria-hidden="true">
                                                                                        </div>

                                                                                        <span
                                                                                            class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                                                            aria-hidden="true">&#8203;</span>

                                                                                        <div
                                                                                            x-show="show"
                                                                                            x-transition:enter="ease-out duration-300"
                                                                                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                                                            x-transition:leave="ease-in duration-200"
                                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                                            @click.away="show = false"
                                                                                            @click.stop
                                                                                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                                                                        >
                                                                                            <div
                                                                                                class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                                                <div
                                                                                                    class="sm:flex sm:items-start">
                                                                                                    <div
                                                                                                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                                                        <svg
                                                                                                            class="h-6 w-6 text-red-600"
                                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                                            fill="none"
                                                                                                            viewBox="0 0 24 24"
                                                                                                            stroke="currentColor"
                                                                                                            aria-hidden="true">
                                                                                                            <path
                                                                                                                stroke-linecap="round"
                                                                                                                stroke-linejoin="round"
                                                                                                                stroke-width="2"
                                                                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                                                                        </svg>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                                                        <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                                                                            id="modal-title">
                                                                                                            {!! __('Confirm Cancellation') !!}
                                                                                                        </h3>
                                                                                                        <div
                                                                                                            class="mt-2">
                                                                                                            <p class="text-sm text-gray-700 text-wrap">
                                                                                                                {!! __('Are you sure you want to cancel this request?') !!}
                                                                                                                :
                                                                                                                <span
                                                                                                                    class="font-semibold">{{ $request->title }}</span>?
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="bg-gray-50 bg-opacity-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                                                <button type="button"
                                                                                                        wire:click="confirmCancelRequest"
                                                                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm
                                                                                                    transition ease-in-out duration-150 transform hover:scale-105">
                                                                                                    {!! __('Confirm') !!}
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                        wire:click="closeModal"
                                                                                                        x-on:click="$nextTick(() => $wire.$refresh())"
                                                                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition ease-in-out duration-150 transform hover:scale-105">
                                                                                                    {{ __('Cancel') }}
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                        @if($request->status === SchoolRequestStatus::Draft->value)
                                                                            <a href="{{ route('student.updated-request',$request->id) }}"
                                                                               class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 text-gray-700 dark:text-gray-200 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                                                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                                                                    <path d="M16.2141 4.98239L17.6158 3.58063C18.39 2.80646 19.6452 2.80646 20.4194 3.58063C21.1935 4.3548 21.1935 5.60998 20.4194 6.38415L19.0176 7.78591M16.2141 4.98239L10.9802 10.2163C9.93493 11.2616 9.41226 11.7842 9.05637 12.4211C8.70047 13.058 8.3424 14.5619 8 16C9.43809 15.6576 10.942 15.2995 11.5789 14.9436C12.2158 14.5877 12.7384 14.0651 13.7837 13.0198L19.0176 7.78591M16.2141 4.98239L19.0176 7.78591" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                                    <path d="M21 12C21 16.2426 21 18.364 19.682 19.682C18.364 21 16.2426 21 12 21C7.75736 21 5.63604 21 4.31802 19.682C3 18.364 3 16.2426 3 12C3 7.75736 3 5.63604 4.31802 4.31802C5.63604 3 7.75736 3 12 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                                                </svg>
                                                                                <span
                                                                                    class="flex-1 truncate text-start">
                                                                                {!! __('Update') !!}
                                                                            </span>
                                                                            </a>
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

                                {{$requests->links('livewire.settings.pagination')}}
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
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('modalClosed', () => {
            setTimeout(() => window.location.reload(), 100);
        });
    });
</script>
