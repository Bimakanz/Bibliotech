<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-[1.5rem] bg-[#0f766e] px-5 py-2.5 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/30 focus:ring-offset-2 focus:ring-offset-white disabled:cursor-not-allowed disabled:bg-[#b3c0b9] disabled:text-white/80']) }}>
    {{ $slot }}
</button>
