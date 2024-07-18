@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-3 text-base text-foreground']) }}>
    {{ $value ?? $slot }}
</label>
