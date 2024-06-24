<style>
    .toast-enter-active, .toast-leave-active {
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .toast-enter, .toast-leave-to {
        opacity: 0;
        transform: translateY(-20px);
    }
</style>
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
           {!! $slot !!}
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
