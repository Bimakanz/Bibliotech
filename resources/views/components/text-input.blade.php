@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] shadow-sm focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20 disabled:cursor-not-allowed disabled:bg-[#f6f1e8]']) }}>
