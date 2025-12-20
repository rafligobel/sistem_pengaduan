@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full px-3 py-2.5 rounded-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-sm'
            : 'flex items-center w-full px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
