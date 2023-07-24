@extends('statamic::layout')
@section('title', 'Vercel')

@section('content')

    @if ($hasBreadcrumb)
        @include('statamic::partials.breadcrumb', [
            'url' => cp_route('vercel-statamic.index'),
            'title' => 'zurück',
        ])
    @endif

    <header class="w-full h-auto flex flex-row flex-nowrap gap-8">
        <h1 class="w-full">{{ $title }}</h1>

        <div class="flex flex-row gap-4 ml-auto mr-0">
            {{ $buttons }}
        </div>
    </header>

    <x-vercel-statamic::navigation />

    <main>
        {{ $slot }}
    </main>



    @include('statamic::partials.docs-callout', [
        'topic' => 'Vercel Statamic',
        'url' => 'https://vercel-statamic.morethings.digital/docs',
    ])

@endsection
