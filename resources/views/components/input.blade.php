@props(['disabled' => false, 'wire' => null,'placeholder'=>null,'value'=>null])

<input value="jdjd" placeholder="{!! $placeholder !!}" {{ $wire ? "wire:model.defer={$wire}" : '' }} {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-4 mb-1 py-[15px] block w-full border-gray-200 rounded-lg text-sm focus:border-success-500 focus:ring-success-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600']) !!}>
