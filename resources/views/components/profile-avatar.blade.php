@props([
    'circular' => true,
    'size' => 'md',
    'src' => null,
    'alt' => 'Profile Avatar',
    'wire:model' => null,
    'default',
    'wire'=>null
])

@php
    $sizeClasses = [
        'sm' => 'h-12 w-12',
        'md' => 'h-48 w-48',
        'lg' => 'h-60 w-60',
    ];
    $sizeClass = $sizeClasses[$size] ?? $size;
    $inputId = $attributes->wire('model')->value() ?? 'profileAvatar';
@endphp

<div wire:ignore {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description??'' }}</x-slot>
    </x-section-title>
    <div class="mt-5 md:mt-0 col-span-2">
        <div

                x-data="{
        previewUrl: '{{ $src }}',
        inputElement: null,
        updatePreview() {
            const file = this.inputElement.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewUrl = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        triggerFileInput() {
            this.inputElement.click();
        }
    }"
                x-init="inputElement = $refs.fileInput"
                class="w-full flex justify-center {{ $attributes->get('class') }}"
        >
            <div
                    @click="triggerFileInput"
                    class="cursor-pointer relative inline-block"
            >
                <img
                        :src="previewUrl || '{{$default}}'"
                        alt="{{ $alt }}"
                        title="{{ $alt }}"
                        :class="{
                'fi-avatar object-cover object-center': true,
                'rounded-md': {{ $circular ? 'false' : 'true' }},
                'fi-circular rounded-full': {{ $circular ? 'true' : 'false' }},
                '{{ $sizeClass }}': true
            }"
                />
                <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200 rounded-full"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <input wire:model="{{$wire}}"
                    type="file"
                    {{ $attributes->wire('model') }}
                    x-ref="fileInput"
                    @change="updatePreview"
                    class="hidden"
                    id="{{ $inputId }}"
                accept="image/*"
            >
        </div>
    </div>
</div>
