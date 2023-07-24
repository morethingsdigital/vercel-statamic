<x-vercel-statamic::app-layout hasBreadcrumb>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="buttons">
        @if ($latestDeploymentId)
            <x-vercel-statamic::deploy-button :id="$latestDeploymentId" />
        @endif
    </x-slot>

    @if (count($deployments) > 0)
        <ul class="flex flex-col gap-4">
            @foreach ($deployments as $deployment)
                <li class="w-full h-auto ">
                    <x-vercel-statamic::deployment-card :id="$deployment->id" :name="$deployment->name" :domain="$deployment->domain"
                        :state="$deployment->state" :creator="$deployment->creator" :branch="$deployment->meta->branch" :repo="$deployment->meta->repo" />
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

</x-vercel-statamic::app-layout>
