<x-vercel-statamic::app-layout hasBreadcrumb>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="buttons">
        @if ($latestDeploymentId)
            <x-vercel-statamic::deploy-button :id="$latestDeploymentId" />
        @endif
    </x-slot>

    {{-- <nav class="w-full h-auto mb-4 ">
        <span class="isolate inline-flex rounded-md shadow-sm">
            <button type="button"
                class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">All</button>
            <button type="button"
                class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Production</button>
            <button type="button"
                class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Preview</button>
        </span>
    </nav> --}}

    <section class="w-full h-auto">
        @if (count($deployments) > 0)
            <ul class="flex flex-col gap-4">
                @foreach ($deployments as $deployment)
                    <li class="w-full h-auto ">
                        <x-vercel-statamic::deployment-card :id="$deployment->id" :name="$deployment->name" :domain="$deployment->domain"
                            :state="$deployment->state" :creator="$deployment->creator" :branch="$deployment->meta->branch" :repo="$deployment->meta->repo" :environment="$deployment->environment" />
                    </li>
                @endforeach
            </ul>

            <x-vercel-statamic::pagination :currentPage="$pagination->currentPage()" :nextPage="$pagination->nextPage()" />
        @else
            <div>
                <h3>Sorry no current deployments found!</h3>
                <p>Currently no deployments are triggered in Vercel.</p>
            </div>
        @endif
    </section>

</x-vercel-statamic::app-layout>
