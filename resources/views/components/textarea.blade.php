@props(['name', 'wire' => null,'placeholder'=>null])
<textarea
        placeholder="{!! $placeholder !!}"
     {{ $wire ? "wire:model.defer={$wire}" : '' }}
        {{
        $attributes->merge(['class'=>'px-4 mb-4 py-[15px] block w-full border-gray-200 rounded-lg text-sm focus:border-success-500 focus:ring-success-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600'])
        }}>
{!! $slot !!}
</textarea>
