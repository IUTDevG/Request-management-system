<div class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] ps-px sm:ps-3">
    <button
        class="inline-flex justify-center items-center gap-1 text-sm font-medium text-gray-600 hover:text-neutral-500 dark:text-neutral-400 dark:hover:text-neutral-300">
        @if(app()->getLocale()==='fr')
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" id="flag-icons-fr" viewBox="0 0 640 480">
                <path fill="#fff" d="M0 0h640v480H0z"/>
                <path fill="#000091" d="M0 0h213.3v480H0z"/>
                <path fill="#e1000f" d="M426.7 0H640v480H426.7z"/>
            </svg>
            <span class="hidden md:block">
                    {{__('French')}}
                    </span>
        @elseif(app()->getLocale()==='en')
            <svg class="h-4 w-4 fill-slate-400" xmlns="http://www.w3.org/2000/svg"
                 id="flag-icons-gb-eng" viewBox="0 0 640 480">
                <path fill="#fff" d="M0 0h640v480H0z"/>
                <path fill="#ce1124" d="M281.6 0h76.8v480h-76.8z"/>
                <path fill="#ce1124" d="M0 201.6h640v76.8H0z"/>
            </svg>
            <span class="hidden md:block">
                    {{__('English')}}
            </span>
        @endif
    </button>
    <div
            class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 hidden z-10 bg-white sm:shadow-md rounded-lg p-2 dark:bg-neutral-800 sm:dark:border dark:border-neutral-700 dark:divide-neutral-700 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5">
        <button wire:click.prevent="updateCurrentLanguage('en')"
                class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-green-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                href="#">
            <svg class="h-4 w-4 fill-slate-400" xmlns="http://www.w3.org/2000/svg"
                 id="flag-icons-gb-eng" viewBox="0 0 640 480">
                <path fill="#fff" d="M0 0h640v480H0z"/>
                <path fill="#ce1124" d="M281.6 0h76.8v480h-76.8z"/>
                <path fill="#ce1124" d="M0 201.6h640v76.8H0z"/>
            </svg>
            {{__('English')}}
        </button>
        <button wire:click="updateCurrentLanguage('fr')"
                class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-green-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                href="#">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" id="flag-icons-fr" viewBox="0 0 640 480">
                <path fill="#fff" d="M0 0h640v480H0z"/>
                <path fill="#000091" d="M0 0h213.3v480H0z"/>
                <path fill="#e1000f" d="M426.7 0H640v480H426.7z"/>
            </svg>
            {{__('French')}}
        </button>
    </div>
</div>
