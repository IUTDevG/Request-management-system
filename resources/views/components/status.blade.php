@props([
    'type' => 'success',
    'duration' => 3000,
    'position' => 'top-right',
    'message' => null
])

@php
    $bgColors = [
        'success' => 'bg-green-500',
        'error' => 'bg-red-500',
        'warning' => 'bg-yellow-500',
        'info' => 'bg-blue-500'
    ];
    $icons = [
        'success' => '<path d="M8 12.5L10.5 15L16 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'error' => '<path d="M13 11L13 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M13 8L13 8.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
        'warning' => '<path d="M12 8V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M12 16L12 16.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
        'info' => '<path d="M12 8L12 8.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M12 11L12 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>'
    ];
    $positionClasses = [
        'top-right' => 'top-5 right-5',
        'top-left' => 'top-5 left-5',
        'bottom-right' => 'bottom-5 right-5',
        'bottom-left' => 'bottom-5 left-5',
    ];
@endphp

<div x-data="{
    show: {{ session()->has('status') ? 'true' : 'false' }},
    message: '{{ $message ?? session('status') }}',
    timeout: null,
    duration: {{ $duration }},
    type: '{{ $type }}',
    init() {
        if (this.show) {
            this.showToast();
        }
    },
    showToast(newMessage = null, newType = null, newDuration = null) {
        if (newMessage) this.message = newMessage;
        if (newType) this.type = newType;
        if (newDuration) this.duration = newDuration;
        clearTimeout(this.timeout);
        this.show = true;
        this.timeout = setTimeout(() => this.show = false, this.duration);
    }
}"
     x-init="init()"
     @notify.window="showToast($event.detail.message, $event.detail.type, $event.detail.duration)"
     class="relative"
>
    <style>
        .toast-enter-active, .toast-leave-active {
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .toast-enter, .toast-leave-to {
            opacity: 0;
            transform: translateY(-20px);
        }
    </style>

    <div x-show="show"
         x-transition:enter="toast-enter-active"
         x-transition:enter-start="toast-enter"
         x-transition:leave="toast-leave-active"
         x-transition:leave-end="toast-leave-to"
         class="fixed z-[100] text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-4 {{ $positionClasses[$position] }} {{ $bgColors[$type] }}"
         style="display: none;">
        <div>
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                <path d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z" stroke="currentColor" stroke-width="1.5"/>
                {!! $icons[$type] !!}
            </svg>
        </div>
        <div x-html="message">{{ $slot }}</div>
        <button @click="show = false; clearTimeout(timeout)" class="text-white">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none">
                <path d="M19.0005 4.99988L5.00045 18.9999M5.00045 4.99988L19.0005 18.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>
