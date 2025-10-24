@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#0f766e] text-start text-base font-semibold text-[#0f766e] bg-[#0f766e]/10 focus:outline-none focus:text-[#0f766e] focus:bg-[#0f766e]/15 focus:border-[#115e59] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-semibold text-[#4c5b54] hover:text-[#0f766e] hover:bg-[#fdf4e3] hover:border-[#dcd2bd] focus:outline-none focus:text-[#0f766e] focus:bg-[#fdf4e3] focus:border-[#0f766e]/40 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
