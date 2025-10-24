@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm font-medium text-[#166534]']) }}>
        {{ $status }}
    </div>
@endif
