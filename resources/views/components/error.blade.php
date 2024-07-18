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
         class="fixed z-[100] top-5 right-5 bg-danger-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-4"
         style="display: none;">
        <div>
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                <path d="M15.7494 15L9.75 9M9.75064 15L15.75 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M22.75 12C22.75 6.47715 18.2728 2 12.75 2C7.22715 2 2.75 6.47715 2.75 12C2.75 17.5228 7.22715 22 12.75 22C18.2728 22 22.75 17.5228 22.75 12Z" stroke="currentColor" stroke-width="1.5" />
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
