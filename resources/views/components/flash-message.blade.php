@props([
    'on' => 'saved',
    'duration' => 2000,
    'transitionDuration' => 1500
])

@php
    $uniqueId = 'flash-' . uniqid();
@endphp

<div
    x-data="{
        shown: false,
        timeout: null,
        message: '',
        type: 'success',
        show(msg, type, duration) {
            clearTimeout(this.timeout);
            this.message = msg;
            this.type = type;
            this.shown = true;
            this.timeout = setTimeout(() => {
                this.shown = false;
            }, duration);
        }
    }"
    x-init="
        $wire.on('{{ $on }}', (msg, type, customDuration) => {
            if (msg.target === '{{ $uniqueId }}' || msg.target === undefined) {
                show(msg.message || msg, type, customDuration || {{ $duration }});
            }
        });

        @if (session()->has($on . '-success'))
            show('{{ session($on . '-success') }}', 'success', {{ $duration }});
        @endif

        @if (session()->has($on . '-error'))
            show('{{ session($on . '-error') }}', 'error', {{ $duration }});
        @endif

        @if (session()->has($on))
            show('{{ session($on) }}', 'success', {{ $duration }});
        @endif
    "
    x-show.transition.out.opacity.duration.{{ $transitionDuration }}ms="shown"
    x-transition:leave.opacity.duration.{{ $transitionDuration }}ms
    style="display: none;"
    {{ $attributes->merge(['class' => 'text-sm']) }}
    id="{{ $uniqueId }}"
>
    <div x-text="message" :class="{'text-green-500': type === 'success', 'text-red-500': type === 'error'}"></div>
</div>
