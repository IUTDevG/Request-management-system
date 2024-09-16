@props(['for'])

@error($for)
<div
    x-data="{ show: false }"
    x-init="() => {
        setTimeout(() => show = true, 100);
        setTimeout(() => show = false, 3000);
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
>
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 mb-3']) }}>
        {{ $message }}
    </p>
</div>
@enderror
