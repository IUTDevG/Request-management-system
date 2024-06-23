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
    class="p-2">
    <button x-ref="button"
        x-on:click="toggle()"
        :aria-expanded="open"
        :aria-controls="$id('dropdown-lang')"
        class="inline-flex justify-center items-center gap-1 text-sm font-medium text-gray-600 hover:text-neutral-500 dark:text-neutral-400 dark:hover:text-neutral-300">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none">
            <path d="M2 12C2 13.0519 2.18046 14.0617 2.51212 15M13.0137 9H21.5015M11 15H2.51212M21.5015 9C20.266 5.50442 16.9323 3 13.0137 3C14.6146 3 15.9226 6.76201 16.0091 11.5M21.5015 9C21.7803 9.78867 21.9522 10.6278 22 11.5M2.51212 15C3.74763 18.4956 7.08134 21 11 21C9.45582 21 8.18412 17.5 8.01831 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M2 5.29734C2 4.19897 2 3.64979 2.18738 3.22389C2.3861 2.77223 2.72861 2.40921 3.15476 2.1986C3.55661 2 4.07478 2 5.11111 2H6C7.88562 2 8.82843 2 9.41421 2.62085C10 3.2417 10 4.24095 10 6.23944V8.49851C10 9.37026 10 9.80613 9.73593 9.95592C9.47186 10.1057 9.12967 9.86392 8.4453 9.38036L8.34103 9.30669C7.84086 8.95329 7.59078 8.77658 7.30735 8.68563C7.02392 8.59468 6.72336 8.59468 6.12223 8.59468H5.11111C4.07478 8.59468 3.55661 8.59468 3.15476 8.39608C2.72861 8.18547 2.3861 7.82245 2.18738 7.37079C2 6.94489 2 6.39571 2 5.29734Z" stroke="currentColor" stroke-width="1.5" />
            <path d="M22 17.2973C22 16.199 22 15.6498 21.8126 15.2239C21.6139 14.7722 21.2714 14.4092 20.8452 14.1986C20.4434 14 19.9252 14 18.8889 14H18C16.1144 14 15.1716 14 14.5858 14.6209C14 15.2417 14 16.2409 14 18.2394V20.4985C14 21.3703 14 21.8061 14.2641 21.9559C14.5281 22.1057 14.8703 21.8639 15.5547 21.3804L15.659 21.3067C16.1591 20.9533 16.4092 20.7766 16.6926 20.6856C16.9761 20.5947 17.2766 20.5947 17.8778 20.5947H18.8889C19.9252 20.5947 20.4434 20.5947 20.8452 20.3961C21.2714 20.1855 21.6139 19.8225 21.8126 19.3708C22 18.9449 22 18.3957 22 17.2973Z" stroke="currentColor" stroke-width="1.5" />
        </svg>
        @if(app()->getLocale()==='fr')
            <span class="hidden md:block">
                    {{__('French')}}
                    </span>
        @elseif(app()->getLocale()==='en')
            <span class="hidden md:block">
                    {{__('English')}}
            </span>
        @endif
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
        :id="$id('dropdown-lang')"
        style="display: none;    position: absolute;
                            inset: 0px 0px auto auto;
                            margin: 0px;
                            transform: translate3d(-68px, 70.4px, 0px); "
            class="transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] sm:w-48 z-10 bg-white sm:shadow-md rounded-lg p-2 dark:bg-gray-900 sm:dark:border dark:border-neutral-700 dark:divide-neutral-700 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5">
        <button wire:click.prevent="updateCurrentLanguage('en')"
                class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 focus:ring-2 focus:ring-green-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
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
                class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 focus:ring-2 focus:ring-green-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
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
