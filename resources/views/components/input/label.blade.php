@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm font-medium text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>
