<nav {{ $attributes->merge(['class' => 'tabs-container relative mt-4']) }}>
    @if ($vercelStatamicNavigationItems)
        <ul class="tabs flex-1 flex space-x-3 overflow-auto pr-6">
            @foreach ($vercelStatamicNavigationItems as $vercelStatamicNavigationItem)
                <li
                    class="tab-button {{ request()->routeIs('statamic.cp.' . $vercelStatamicNavigationItem['route']) ? 'active' : '' }} {{ $vercelStatamicNavigationItem['isDisabled'] ? ' opacity-50  cursor-not-allowed' : '' }}">
                    @if ($vercelStatamicNavigationItem['isDisabled'])
                        <p>{{ $vercelStatamicNavigationItem['key'] }} (Cooming Soon!)</p>
                    @else
                        <a
                            href="{{ cp_route($vercelStatamicNavigationItem['route']) }}">{{ $vercelStatamicNavigationItem['key'] }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</nav>
