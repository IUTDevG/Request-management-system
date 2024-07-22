<div>
    @use('App\Enums\SchoolRequestStatus')

    <!-- Toast -->
    @if (session('status'))
        <x-status type="success" position="top-right">
            {!! session('status') !!}
        </x-status>
    @endif

    @session('error')

    <x-error> {!! session('error') !!} .</x-error>

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
            <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto min-[835px]:flex min-[835px]:justify-end">
                <!-- flex -->
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Search Input -->
                    <div class="w-full sm:w-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg wire:loading.remove.delay.default="" wire:target="searchTerm"
                                     class="flex-shrink-0 size-4 text-gray-400 dark:text-white/60"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                                <svg wire:loading.delay.default wire:target="searchTerm"
                                     class="flex-shrink-0 size-4 text-gray-400 animate-spin dark:text-gray-500"
                                     fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd"
                                          d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                          fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                          fill="currentColor">
                                    </path>
                                </svg>
                            </div>
                            <input wire:model.live.debounce="searchTerm"
                                   class="py-3 ps-10 pe-4 block w-full border-gray-200 ring-green-500 rounded-lg text-sm focus:border-success-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-success-500 focus:outline-none focus:ring-offset-2 focus:ring-offset-green-500 transition-all duration-300"
                                   type="search" placeholder="{!! __('Search') !!}">
                        </div>
                    </div>

                    <!-- Filter Dropdown -->
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
    }" class="relative inline-block text-left w-full sm:w-auto">
                        <button type="button" @click="toggleDropdown" @keydown.escape.window="isOpen = false"
                                :class="{ 'ring-2 ring-green-500 bg-white dark:bg-neutral-800': isOpen }"
                                class="inline-flex justify-between w-full rounded-lg border border-gray-300 shadow-sm px-4 py-3 bg-white text-sm font-medium dark:bg-neutral-900 dark:border-gray-700 dark:text-neutral-400 hover:bg-gray-50 dark:hover:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-offset-success-500 focus:ring-green-500 transition-all duration-300"
                                aria-haspopup="true" :aria-expanded="isOpen">
                            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path
                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"/>
                </svg>
                <span
                    x-text="selectedOption ? options.find(o => o.value === selectedOption).label : '{{ __('Filter') }}'"></span>
            </span>
                            <svg class="h-5 w-5 text-gray-400 transition-transform duration-300"
                                 :class="{ 'transform rotate-180': isOpen }"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <div x-show="isOpen" @click.away="isOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-neutral-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-10"
                             role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <div class="py-1" role="none">
                                <template x-for="option in options" :key="option.value">
                                    <button @click="selectOption(option)"
                                            class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors duration-200"
                                            role="menuitem">
                                        <span class="flex-grow" x-text="option.label"></span>
                                        <svg x-show="selectedOption === option.value"
                                             class="h-5 w-5 text-green-600 dark:text-green-400"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
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
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                                <span
                                                    class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                                                       {{__('Updated at')}}
                                                    </span>
                                                </span>
                                            </th>

                                            <th class="w-1"></th>

                                        </tr>
                                        </thead>
                                        <x-students.tbody :requests="$requests" :showCancelModal="$showCancelModal"/>


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

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.
                on('modalClosed', () => {
                    setTimeout(() => window.location.reload(), 100);
                });
            });
        </script>
    @endpush
</div>
