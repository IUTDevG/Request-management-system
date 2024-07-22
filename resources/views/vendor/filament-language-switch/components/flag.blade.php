@props([
    'src',
    'alt' => '',
    'circular' => false,
    'switch' => false,
])
<img
    src="{{ $src }}"
    {{ $attributes
        ->class([
            'object-cover object-center h-4 w-6',
            'rounded-full' => $circular,
        ])
    }}
/>
