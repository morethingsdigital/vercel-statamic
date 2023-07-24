<x-vercel-statamic::app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="buttons">
        @if ($latestDeploymentId)
            <x-vercel-statamic::deploy-button :id="$latestDeploymentId" />
        @endif
    </x-slot>

    Hallo Vercel Statamic

</x-vercel-statamic::app-layout>
