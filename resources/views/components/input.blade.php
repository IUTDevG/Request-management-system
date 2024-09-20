@props([
    'disabled' => false,
    'wire' => null,
    'placeholder' => null,
    'value' => null,
    'isPassword' => false,
    'type' => 'text'
])

<div x-data="{ showPassword: false,
               focus: false,
               get inputType() { return this.showPassword ? 'text' : 'password' } }"
     class="relative"
     @focusin="focus = true"
     @focusout="focus = false">
    <input
        value="{{ $value }}"
        placeholder="{!! $placeholder !!}"
        {{ $wire ? "wire:model={$wire}" : '' }}
        {{ $disabled ? 'disabled' : '' }}
        :type="{{ $isPassword ? 'inputType' : $type }}"
        @if($isPassword)
            x-bind:class="{ 'pr-10': {{ $isPassword}} }"
        @endif
        {!! $attributes->merge(['class' => 'px-4 mb-1 py-[15px] block w-full border-gray-200 rounded-lg text-sm focus:border-success-500 focus:ring-success-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 transition-all duration-300 ease-in-out']) !!}>

    @if($isPassword)
        <button type="button"
                @click="showPassword = !showPassword"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600
                focus:outline-none transition-all duration-300 ease-in-out"
                :class="{ 'text-success-500': focus }"
                x-cloak>
            <span class="sr-only" x-text="showPassword ? 'Hide password' : 'Show password'"></span>
            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
            </svg>
        </button>
    @endif
</div>
