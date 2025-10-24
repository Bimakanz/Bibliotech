@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#0f766e] text-sm font-semibold leading-5 text-[#172a37] focus:outline-none focus:border-[#115e59] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-[#6b766f] hover:text-[#0f766e] hover:border-[#dcd2bd] focus:outline-none focus:text-[#0f766e] focus:border-[#0f766e]/40 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
