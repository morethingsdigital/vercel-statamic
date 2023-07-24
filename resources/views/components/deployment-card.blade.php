<div {{ $attributes->merge(['class' => 'card w-full h-auto relative grid grid-cols-12 gap-4 items-center']) }}>
    <div class="col-span-7">
        <h2 class="text-lg text-black font-bold">
            <span>{{ $name }}</span>

            <x-vercel-statamic::state-badge :state="$state" class="ml-4" />
        </h2>
        <p class="text-sm text-black mt-2">{{ $domain }}</p>

    </div>
    <div class="col-span-3">
        {{-- <div>{{ $repo }}</div>
        <span
            class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{ $branch }}</span> --}}

    </div>
    <div class="col-span-1">
        <x-vercel-statamic::avatar :id="$creator->id" :name="$creator->name" :email="$creator->email" />
    </div>
    <div class="col-span-1 flex items-center justify-end flex-row flex-nowrap gap-4">
        <x-vercel-statamic::action-button :href="$url" target="_blank" icon="expand" label="Serve Url" />
        {{-- <x-vercel-statamic::action-button :href="cp_route('vercel-statamic.deployments.show', ['id' => $id])" icon="chevron-right" label="Show Details" /> --}}
    </div>
</div>
