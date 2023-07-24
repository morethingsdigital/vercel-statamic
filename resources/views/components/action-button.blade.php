<{{ $tag }}
    @if ($href) href="{{ $href }}"  @if ($target) target="{{ $target }}" @endif
    @endif
    {{ $attributes->merge(['class' => 'bg-white text-black rounded-full w-6 h-6 inline-flex items-center justify-center hover:!text-gray-500']) }}>
    @if ($icon)
        <x-vercel-statamic::icon :name="$icon" />
    @endif

    @if ($label)
        <span class="text-base text-current sr-only">{{ $label }}</span>
    @endif
    </{{ $tag }}>
