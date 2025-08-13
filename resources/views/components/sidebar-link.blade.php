@props(['active'])

@php
$classes = ($active ?? false)
? 'flex items-center px-3 py-2 text-sm font-medium rounded-md text-white bg-gray-900'
: 'flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-400 hover:text-white hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex-shrink-0 w-6 h-6">
        {{ $icon }}
    </div>
    <span class="ml-3">{{ $slot }}</span>
</a>