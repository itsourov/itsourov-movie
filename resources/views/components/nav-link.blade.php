@props(['active'])

@php
    if ($active ?? false) {
        $classes = 'text-base font-medium  transition-all duration-200 text-blue-600 ';
    } else {
        $classes = 'text-base font-medium text-black transition-all duration-200 hover:text-blue-600 ';
    }
    
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
