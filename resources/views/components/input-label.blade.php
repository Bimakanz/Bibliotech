@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]']) }}>
    {{ $value ?? $slot }}
</label>
