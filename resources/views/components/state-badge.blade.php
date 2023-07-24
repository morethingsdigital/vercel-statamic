<span
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium text-gray-900 ring-1 ring-inset ring-gray-200']) }}>
    <svg class="h-1.5 w-1.5 " viewBox="0 0 6 6" aria-hidden="true">
        <circle cx="3" cy="3" r="3" fill="{{ $state->color() }}" />
    </svg>
    {{ $state->label() }}
</span>
