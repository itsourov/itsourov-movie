@props(['active'])

@php
    if ($active ?? false) {
        $classes = 'bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium';
    } else {
        $classes = 'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium';
    }
    
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
