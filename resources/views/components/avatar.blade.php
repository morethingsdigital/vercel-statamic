<div
    {{ $attributes->merge(['class' => 'avatar relative w-8 h-8 inline-flex items-center justify-center rounded-full bg-gray-200 group cursor-pointer']) }}>
    <span class="text-sm font-medium leading-none text-black uppercase">{{ $initials }}</span>
    @if ($email)
        <span
            class="hidden absolute top-full left-1/2 transform -translate-x-1/2 translate-y-2 bg-black text-white text-xs px-1.5 py-0.5 rounded group-hover:!flex">{{ $email }}</span>
    @endif
</div>
