@props(['value'])

<label {{ $attributes->merge(['class' => 'text-base font-medium text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>
