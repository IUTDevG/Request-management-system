<!-- select-component.blade.php -->
@props([
    'label',
    'id',
    'name',
    'options',
    'placeholder' => '',
    'selected' => '',
    'wire' => null
])

<div class="mb-3">
    <label for="{{ $id }}" class="block text-sm font-medium mb-2 dark:text-white">{{ $label }}</label>
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $wire ? "wire:model.defer={$wire}" : '' }}
        {{ $attributes->merge(['class' => 'py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600']) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $option)
            <option value="{{ $option->id }}" {{ $selected === $option->id ? 'selected' : '' }}>
                {{ __($option->name) }}
            </option>
        @endforeach
    </select>
</div>
