@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'block w-full p-2.5  placeholder-gray-500 transition-all duration-200 border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 focus:outline-none focus:border-blue-600 focus:bg-white  caret-blue-600',
]) !!}>
