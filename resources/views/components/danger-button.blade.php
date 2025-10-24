<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-[1.5rem] bg-[#be123c] px-5 py-2.5 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#991b1b] focus:outline-none focus:ring-2 focus:ring-[#f87171]/30 focus:ring-offset-2 focus:ring-offset-white disabled:opacity-60']) }}>
    {{ $slot }}
</button>
