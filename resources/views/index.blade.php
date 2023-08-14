<x-vercel-statamic::app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="buttons">
        @if ($latestDeploymentId)
            <x-vercel-statamic::deploy-button :id="$latestDeploymentId" />
        @endif
    </x-slot>

    <section class="container grid grid-cols-6 gap-4 md:grid-cols-12 ">
        <div class="col-span-full">
            <x-vercel-statamic::purge-cache-card />
        </div>
    </section>

</x-vercel-statamic::app-layout>
