<!doctype html>
<html lang="{{str_replace('_','-',app()->getLocale())}}" x-data="themeSwitcher()">
<head>
    <meta charset="UTF-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'/*,'resources/js/alpine.js'*/])
    @stack('styles')
    @livewireStyles
    <script src="{!! asset('js/darkMode.js') !!}"></script>
    <title>{{$title.'- IUT'??'Dashboard'}}</title>
</head>
<body :class="themeClass" class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden antialiased relative min-h-screen">
<!-- ========== HEADER ========== -->
<x-preloader/>
<header
    class="flex sticky flex-wrap sm:justify-start sm:flex-nowrap bg-white dark:bg-gray-900 antialiased shadow-lg z-50 w-full text-sm py-2 sm:py-0">
    <!--===Navbar section===-->
    <nav class="relative max-w-[85rem] w-full mx-auto px-4 filepond flex items-center justify-between sm:px-6 lg:px-8"
         aria-label="Global">
        <div class="flex items-center justify-between w-full">
            <a class="flex-none text-xl font-semibold dark:text-white" href="{{ route('student.home') }}"
               aria-label="Brand">IUT Student panel</a>
            <div class="flex sm:items-center sm:justify-end py-2 md:py-0 sm:ps-7">
                <!--===Global dropdown menu for setting===-->
                <livewire:settings.language-switcher class="inline-flex m-1 relative"/>

                <!--===Global dropdown menu for notification===-->
                <div
                    x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']"
                    class="m-1 hs-dropdown relative inline-flex">
                    <button x-ref="button"
                            x-on:click="toggle()"
                            :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')"
                            id="hs-dropdown-hover-event" type="button"
                            class="m-1 ms-0 relative py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium shadow-sm disabled:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6 text-foreground hover:text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                        </svg>
                        <span class="flex absolute top-0 end-0 -mt-2 -me-2">
                            <span
                                class="animate-ping absolute inline-flex size-full rounded-full bg-green-400 opacity-75 dark:bg-green-600"></span>
                            <span
                                class="relative inline-flex text-xs bg-green-500 text-white rounded-full py-0.5 px-1.5">
                              9+
                            </span>
                            </span>
                    </button>
                    <div
                        x-ref="panel"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        x-on:click.outside="close($refs.button)"
                        :id="$id('dropdown-button')"
                        style="/*display: none;*/    position: fixed;
                            inset: 0px 0px auto auto;
                            margin: 0px;
                            transform: translate3d(-68px, 70.4px, 0px); "
                        class="right-0 z-[1] divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10"
                    >
                        <div
                            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg hover:bg-gray-50 dark:hover:bg-white/5 dark:bg-gray-800 dark:text-white">
                            Notifications
                        </div>
                        <div
                            class="divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10">
                            <a href="#"
                               class="flex px-4 py-3 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                <div class="w-full ps-3">
                                    <div class="text-foreground text-sm mb-1.5">New message from <span
                                            class="font-semibold text-gray-900 dark:text-white">Jese Leos</span>: "Your
                                        request is here"
                                    </div>
                                    <div class="text-xs text-green-600 dark:text-green-500">a few moments ago</div>
                                </div>
                            </a>
                        </div>
                        <a href="{{ route('student.notifications') }}"
                           class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                            <div class="inline-flex items-center ">
                                <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                    <path
                                        d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                </svg>
                                View all
                            </div>
                        </a>
                    </div>
                </div>
                <!--===Global dropdown menu for profile===-->
                <div
                    x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']"
                    class="relative inline-flex">
                    <button x-ref="button"
                            x-on:click="toggle()"
                            :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')"
                            type="button"
                            class="inline-flex items-center gap-x-2 text-sm font-medium shadow-sm disabled:opacity-50 disabled:pointer-events-none ">
                            <span class="relative inline-block">
                                <img class="inline-block size-8 rounded-full"
                                     src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80"
                                     alt="Image Description">
                            </span>
                    </button>

                    <div x-ref="panel"
                         x-show="open"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-90"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-90"
                         x-on:click.outside="close($refs.button)"
                         :id="$id('dropdown-button')"
                         style="display: none;    position: fixed;
                            inset: 0px 0px auto auto;
                            margin: 0px;
                            transform: translate3d(-68px, 70.4px, 0px); "
                         class="right-0 z-[1] duration min-w-60 divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10"
                    >
                        <div class="py-3 px-5 rounded-t-lg">
                            <p class="text-sm text-gray-500 dark:text-neutral-400">{{__('Signed in as:')}}</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-neutral-300 capitalize">
                                {{auth()->user()->username}}</p>
                        </div>
                        <div class="relative">
                            <div
                                x-data="{
                                    open: false,
                                    toggle() {
                                        this.open = !this.open
                                    },
                                    close() {
                                        this.open = false
                                    }
                                }"
                                x-on:keydown.escape.prevent.stop="close()"
                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                x-id="['dropdown-button']"
                                class="mt-2 relative"
                                x-on:mouseenter="open = true"
                                x-on:mouseleave="close()"
                            >
                                <button
                                    x-ref="button"
                                    x-on:click="toggle()"
                                    :aria-expanded="open"
                                    :aria-controls="$id('dropdown-button')"
                                    type="button"
                                    class="w-full flex justify-between items-center text-sm text-gray-800 rounded-lg py-2 px-3 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 focus:ring-2 dark:text-neutral-400"
                                >
                                    {!! __('Theme') !!}
                                    <svg class="sm:-rotate-90 flex-shrink-0 ms-2 size-4"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"/>
                                    </svg>
                                </button>
                                <div
                                    x-ref="panel"
                                    x-show="open"
                                    x-transition.origin.top.left
                                    x-on:click.outside="close($refs.button)"
                                    :id="$id('dropdown-button')"
                                    class="text-gray-800 fixed dark:text-gray-400 transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] sm:w-48 z-10 sm:mt-2 bg-white sm:shadow-md rounded-lg p-2 dark:bg-gray-900 sm:dark:border dark:border-neutral-700 dark:divide-neutral-700 before:absolute sm:border before:-end-5 before:top-0 before:h-full before:w-5 !mx-[10px] top-0 end-full"
                                >
                                    <button @click="setTheme('light')" data-value="default"
                                            class="flex rounded-[10px] p-1 hover:bg-gray-100 dark:hover:bg-gray-700 w-full">
                                        <span
                                            class="flex h-6 w-6 flex-none items-center justify-center rounded-md shadow ring-1 ring-slate-900/10">
                                            <svg class="h-4 w-4 fill-slate-400">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M7 1C7 0.447715 7.44772 0 8 0C8.55228 0 9 0.447715 9 1V2C9 2.55228 8.55228 3 8 3C7.44772 3 7 2.55228 7 2V1ZM11 8C11 9.65685 9.65685 11 8 11C6.34315 11 5 9.65685 5 8C5 6.34315 6.34315 5 8 5C9.65685 5 11 6.34315 11 8ZM13.6563 2.34285C13.2658 1.95232 12.6326 1.95232 12.2421 2.34285L11.535 3.04996C11.1445 3.44048 11.1445 4.07365 11.535 4.46417C11.9255 4.85469 12.5587 4.85469 12.9492 4.46417L13.6563 3.75706C14.0469 3.36654 14.0469 2.73337 13.6563 2.34285ZM12.242 13.6563L11.5349 12.9492C11.1443 12.5587 11.1443 11.9255 11.5349 11.535C11.9254 11.1445 12.5585 11.1445 12.9491 11.535L13.6562 12.2421C14.0467 12.6326 14.0467 13.2658 13.6562 13.6563C13.2656 14.0468 12.6325 14.0468 12.242 13.6563ZM16 7.99902C16 7.44674 15.5523 6.99902 15 6.99902H14C13.4477 6.99902 13 7.44674 13 7.99902C13 8.55131 13.4477 8.99902 14 8.99902H15C15.5523 8.99902 16 8.55131 16 7.99902ZM7 14C7 13.4477 7.44772 13 8 13C8.55228 13 9 13.4477 9 14V15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15V14ZM4.46492 11.5352C4.0744 11.1447 3.44123 11.1447 3.05071 11.5352L2.3436 12.2423C1.95307 12.6329 1.95307 13.266 2.3436 13.6566C2.73412 14.0471 3.36729 14.0471 3.75781 13.6566L4.46492 12.9494C4.85544 12.5589 4.85544 11.9258 4.46492 11.5352ZM4.46477 3.04973C4.85529 3.44025 4.85529 4.07342 4.46477 4.46394C4.07424 4.85447 3.44108 4.85447 3.05055 4.46394L2.34345 3.75684C1.95292 3.36631 1.95292 2.73315 2.34345 2.34262C2.73397 1.9521 3.36714 1.9521 3.75766 2.34262L4.46477 3.04973ZM3 8C3 7.44772 2.55228 7 2 7H1C0.447715 7 0 7.44772 0 8C0 8.55228 0.447715 9 1 9H2C2.55228 9 3 8.55228 3 8Z"
                                                      fill="#38BDF8"></path>
                                            </svg>
                                        </span>
                                        <span class="ml-3">{!! __('Light') !!}</span>
                                    </button>
                                    <button @click="setTheme('dark')" data-value="dark"
                                            class="flex rounded-[10px] p-1 hover:bg-gray-100 dark:hover:bg-gray-700 w-full">
                                        <div
                                            class="flex h-6 w-6 flex-none items-center justify-center rounded-md shadow ring-1 ring-slate-900/10">
                                            <svg class="h-4 w-4 fill-slate-400">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M7.23 3.333C7.757 2.905 7.68 2 7 2a6 6 0 1 0 0 12c.68 0 .758-.905.23-1.332A5.989 5.989 0 0 1 5 8c0-1.885.87-3.568 2.23-4.668ZM12 5a1 1 0 0 1 1 1 1 1 0 0 0 1 1 1 1 0 1 1 0 2 1 1 0 0 0-1 1 1 1 0 1 1-2 0 1 1 0 0 0-1-1 1 1 0 1 1 0-2 1 1 0 0 0 1-1 1 1 0 0 1 1-1Z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">{!! __('Dark') !!}</div>
                                    </button>
                                    <button @click="setTheme('system')" data-value="system"
                                            class="flex rounded-[10px] p-1 hover:bg-gray-100 dark:hover:bg-gray-700 w-full">
                                        <div
                                            class="flex h-6 w-6 flex-none items-center justify-center rounded-md shadow ring-1 ring-slate-900/10">
                                            <svg class="h-4 w-4 fill-slate-400">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M1 4a3 3 0 0 1 3-3h8a3 3 0 0 1 3 3v4a3 3 0 0 1-3 3h-1.5l.31 1.242c.084.333.36.573.63.808.091.08.182.158.264.24A1 1 0 0 1 11 15H5a1 1 0 0 1-.704-1.71c.082-.082.173-.16.264-.24.27-.235.546-.475.63-.808L5.5 11H4a3 3 0 0 1-3-3V4Zm3-1a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">{!! __('System') !!}</div>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="mt-2 py-2 first:pt-0 last:pb-0">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 focus:ring-2 dark:text-neutral-400"
                               href="profile">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" width="24"
                                     height="24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>

                                {{__('Profile')}}
                            </a>

                            <a href="{{ route('student.logout') }}" wire:navigate
                               class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 focus:ring-2 dark:text-neutral-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" width="24"
                                     height="24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                                </svg>
                                {{__('Log Out')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- ========== END NAVBAR ========== -->
</header>
<!-- ========== END HEADER ========== -->

{{$slot}}
<!-- ========== FOOTER ========== -->
<footer
    class="w-full overflow-hidden bg-white shadow sm:flex sm:items-center sm:justify-center p-4 sm:p-6 xl:p-8 dark:bg-gray-900 antialiased">
    <p class="mb-4 text-sm text-center text-gray-500 dark:text-gray-400 sm:mb-0">
        &copy; 2024-2025 <a href="https://iut-dla.com" class="hover:underline text-success-500" target="_blank">IUT</a>. {{__('All rights reserved.')}}
    </p>
</footer>
<!-- ========== END FOOTER ========== -->
<!--====== END BODY =======-->
@vite('resources/js/app.js')
@stack('scripts')
@livewireScripts
</body>
</html>
