@use('App\Enums\SchoolRequestStatus')
@props([
    'status',
    'request_code',
    'showCancelModal' => false,
    'openCancelModal',
    'title',
])

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
        class="absolute right-[1rem] top-[-1rem] max-sm:translate-x-[1rem] z-10 w-screen divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10 max-w-[14rem]"
    >

        <div class="p-1">
            <a
                href="{{ route('student.request.details',$request_code) }}"
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
                        {!! __('View') !!}
                    </span>
            </a>
            <a
                href="{{ route('student.request.itinerary',$request_code) }}"
                class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors
                duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 hover:bg-gray-50
                focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-custom-500"
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
                        {!! __('View itinerary') !!}
                    </span>
            </a>
            @if($status !== SchoolRequestStatus::Cancelled->value)

                <button type="button"
                        wire:click="{{$openCancelModal}}"
                        wire:key="{!! $request_code !!}"
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
                        x-data="{ show: @entangle('showCancelModal').live, loaded: false }"
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
                        class="fixed inset-0 overflow-y-auto"
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
                                                        class="font-semibold">{{ $title }}</span>?
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
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-success-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition ease-in-out duration-150 transform hover:scale-105">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @if($status === SchoolRequestStatus::Draft->value)
                <a href="{{ route('student.updated-request',$request_code) }}"
                   class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 text-gray-700 dark:text-gray-200 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                    <svg class="size-5"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" width="24"
                         height="24" color="#ffffff"
                         fill="none">
                        <path
                            d="M16.2141 4.98239L17.6158 3.58063C18.39 2.80646 19.6452 2.80646 20.4194 3.58063C21.1935 4.3548 21.1935 5.60998 20.4194 6.38415L19.0176 7.78591M16.2141 4.98239L10.9802 10.2163C9.93493 11.2616 9.41226 11.7842 9.05637 12.4211C8.70047 13.058 8.3424 14.5619 8 16C9.43809 15.6576 10.942 15.2995 11.5789 14.9436C12.2158 14.5877 12.7384 14.0651 13.7837 13.0198L19.0176 7.78591M16.2141 4.98239L19.0176 7.78591"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path
                            d="M21 12C21 16.2426 21 18.364 19.682 19.682C18.364 21 16.2426 21 12 21C7.75736 21 5.63604 21 4.31802 19.682C3 18.364 3 16.2426 3 12C3 7.75736 3 5.63604 4.31802 4.31802C5.63604 3 7.75736 3 12 3"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"/>
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
