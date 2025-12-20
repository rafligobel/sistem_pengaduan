@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-slate-400 bg-white text-slate-900 
                focus:border-blue-600 focus:ring-blue-600 
                rounded-md shadow-sm 
                transition duration-150 ease-in-out',
]) !!}>
