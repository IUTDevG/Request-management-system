<div>
    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notification = document.getElementById('dismiss-toast');
                if (notification) {


                    setTimeout(function () {
                        // notification.classList.remove('opacity-100');
                        notification.classList.add('opacity-0');
                        setTimeout(function () {
                            notification.style.display = 'none';
                        }, 1000);
                    }, 3000);
                }
            });
        </script>
    @endif
    <!-- Toast -->
    @if(session('status'))
        <div id="dismiss-toast"
             class="hs-removing:translate-x-5 absolute top-20 end-2 z-[100] hs-removing:opacity-0 transition duration-300 max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700"
             role="alert">
            <div class="flex p-4">
                <div class="flex-shrink-0">
                    <svg class="flex-shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16"
                         height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                    </svg>
                </div>
                <div class="ms-3">
                    <p class="text-sm text-gray-700 dark:text-neutral-400">
                        {{session('status')}}
                    </p>
                </div>

                <div class="ms-auto">
                    <button type="button"
                            class="inline-flex flex-shrink-0 justify-center items-center size-5 rounded-lg text-gray-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100 dark:text-white"
                            data-hs-remove-element="#dismiss-toast">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
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
                                My requests
                            </p>
                            <p class="text-sm text-start md:text-base text-gray-800 dark:text-neutral-200 mb-2">
                                Manage your requests from a single interface
                            </p>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="text-center sm:text-start flex sm:justify-start sm:items-center gap-x-3 md:gap-x-4">


                        <a href="{{ route('student.new-request') }}"
                           class="py-3 px-4 inline-flex text-nowrap items-center gap-x-2 text-sm font-semibold rounded-lg border border-gray-800 text-gray-800 hover:border-gray-500 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:border-white dark:text-white dark:hover:text-neutral-300 dark:hover:border-neutral-300 hover:scale-100 transition duration-700 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>

                            {{__('New request')}}
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
                        <select data-hs-select='{
                  "placeholder": "<span class=\"inline-flex items-center w-full\"><svg class=\"flex-shrink-0 size-3.5 me-2\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polygon points=\"22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3\"/></svg> Filter</span>",
                  "toggleTag": "<button type=\"button\"></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
                  "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                  "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 size-3.5 text-green-600 dark:text-green-500\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                  "extraMarkup": "<div class=\"absolute top-1/2 end-3 text-center -translate-y-1/2\"><svg class=\"flex-shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                }' class="hidden">
                            <option value="">View all</option>
                            <option>Resolve</option>
                            <option>Reject</option>
                        </select>
                        <!-- End Select -->
                    </div>
                    <div class="w-full ml-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                                <svg class="flex-shrink-0 size-4 text-gray-400 dark:text-white/60"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                            <input
                                class="py-3 ps-10 pe-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                type="text" placeholder="Search" value="">
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
                                        Lists of requests
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Add Request, View and more.
                                    </p>
                                </div>


                            </div>

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
                                                    href="http://mtkits.evenafro.ca/admin/clients/2"
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
                                            <a href="" class="flex w-full disabled:pointer-events-none justify-start text-start">
                                                <div class="grid w-full gap-y-1 px-3 py-4">

                                                    <div class="flex gap-1.5 flex-wrap ">

                                                        <div class="flex w-max">
                                                            <div
                                                                style="--c-50:var(--success-50);--c-400:var(--success-400);--c-600:var(--success-600);"
                                                                class="flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 bg-success-50 text-success-500 ring-success-600/10 dark:bg-success-400/10 dark:text-success-400 dark:ring-success-400/30">


                                                                <span class="grid">
                                                                    <span class="truncate">
                                                                        Valide
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
                                                    href="http://mtkits.evenafro.ca/admin/clients/2"
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

                                                    <div x-data="{
                                                            open:false
                                                        }" class="relative">
                                                        <div x-on:click="open =! open"
                                                             class="flex cursor-pointer">

                                                            <button
                                                                class="relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 -m-2 h-9 w-9 text-primary/50 hover:text-primary/80 focus-visible:ring-primary/600 dark:text-primary-400 dark:hover:text-primary/30 dark:focus-visible:ring-primary/50 "
                                                                type="button">

                                                                <svg class="h-5 w-5"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20"
                                                                     fill="currentColor" aria-hidden="true"
                                                                     data-slot="icon">
                                                                    <path
                                                                        d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"></path>
                                                                </svg>
                                                            </button>

                                                        </div>

                                                        <div x-show="open" role="menu" aria-labelledby="menu-button"
                                                             x-on:click.away="open = false"
                                                             x-float.placement.bottom-end.flip.shift.teleport.offset="{ offset: 2 }"
                                                             x-ref="panel"
                                                             x-transition:enter="transition ease-out duration-200"
                                                             x-transition:enter-start="opacity-0 scale-95"
                                                             x-transition:enter-end="opacity-100 scale-100"
                                                             x-transition:leave="transition ease-in duration-75"
                                                             x-transition:leave-start="opacity-100 scale-100"
                                                             x-transition:leave-end="opacity-0 scale-95"
                                                             @keydown.escape.window="open = false"
                                                             @keydown.tab.prevent="$focus.wrap()"
                                                             class="absolute z-10 w-screen divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10 max-w-[14rem]"
                                                             style="position: fixed; display: none;">

                                                            <div class="p-1">
                                                                <a
                                                                    href="2"
                                                                    class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-info-500"
                                                                    type="button">

                                                                    <svg
                                                                        class="h-5 w-5"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" aria-hidden="true"
                                                                        data-slot="icon">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                                                    </svg>
                                                                    <span
                                                                        class="flex-1 truncate text-start">
                                                                            {!! __('See') !!}
                                                                 </span>


                                                                </a>
                                                                <a
                                                                    href="/edit"
                                                                    class="flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 text-primary-500 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5"
                                                                    >
                                                                    <svg

                                                                        class="h-5 w-5"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" aria-hidden="true"
                                                                        data-slot="icon">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
                                                                    </svg>

                                                                    <span
                                                                        class="flex-1 truncate text-start"
                                                                    >
                                                                        {!! __('Delete') !!}
                                                                    </span>
                                                                </a>

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
