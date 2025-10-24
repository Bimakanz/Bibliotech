<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 rounded-[1.5rem] border border-[#dcd2bd] bg-white px-5 py-2.5 text-sm font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:border-[#0f766e]/40 hover:text-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20 focus:ring-offset-2 disabled:opacity-60']) }}>
    {{ $slot }}
</button>
