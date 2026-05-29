@extends('layouts.app')

@section('title', data_get($data, 'name', 'Egg'))

@section('content')
@php
    $name = data_get($data, 'name', str($slug)->replace('-', ' ')->title());
    $description = data_get($data, 'description', 'No description available.');
    $image = data_get($data, 'image');
    $features = data_get($data, 'features', []);
    $dockerImages = data_get($data, 'docker_images', []);
    $variables = data_get($data, 'variables', []);
@endphp

<div class="mx-auto max-w-6xl px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('eggs.index', ['nest' => $nest]) }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-700 hover:underline dark:text-blue-400">
            <x-tabler-arrow-left class="h-4 w-4" />
            {{ str($nest)->replace('-', ' ')->title() }} eggs
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_18rem]">
        <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex flex-col gap-6 sm:flex-row">
                <div class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-950">
                    @if ($image)
                        <img src="{{ $image }}" alt="{{ $name }}" class="h-full w-full object-cover">
                    @else
                        <x-tabler-eggs class="h-12 w-12 text-zinc-400" />
                    @endif
                </div>

                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">EGG</p>
                    <div class="mt-2 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $name }}</h1>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $file }}</p>
                        </div>

                        <a
                            href="{{ route('eggs.download', ['nest' => $nest, 'egg' => $slug]) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700"
                        >
                            <x-tabler-download class="h-4 w-4" />
                            Download
                        </a>
                    </div>

                    <p class="mt-5 text-base leading-7 text-zinc-700 dark:text-zinc-300">
                        {{ $description }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-sm font-semibold uppercase text-zinc-500 dark:text-zinc-400">Information</h2>
            <dl class="mt-4 space-y-4">
                <div>
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">Nest</dt>
                    <dd class="mt-1 text-sm font-medium text-zinc-900 dark:text-white">{{ str($nest)->replace('-', ' ')->title() }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">Author</dt>
                    <dd class="mt-1 break-words text-sm font-medium text-zinc-900 dark:text-white">{{ data_get($data, 'author', 'Unknown') }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">Exported</dt>
                    <dd class="mt-1 text-sm font-medium text-zinc-900 dark:text-white">{{ data_get($data, 'exported_at') ? \Carbon\Carbon::parse(data_get($data, 'exported_at'))->format('jS M Y H:i (\U\T\C)') : 'Unknown' }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Features</h2>
            <div class="mt-4 flex flex-wrap gap-2">
                @forelse ($features as $feature)
                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">{{ str($feature)->replace('_', ' ')->title() }}</span>
                @empty
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">No features listed.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Docker Images</h2>
            <div class="mt-4 space-y-3">
                @forelse ($dockerImages as $label => $dockerImage)
                    <div>
                        <p class="text-sm font-medium text-zinc-900 dark:text-white">{{ $label }}</p>
                        <p class="mt-1 break-all text-xs text-zinc-500 dark:text-zinc-400">{{ $dockerImage }}</p>
                    </div>
                @empty
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">No images listed.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Variables</h2>
            <div class="mt-4 space-y-3">
                @forelse ($variables as $variable)
                    <div>
                        <p class="text-sm font-medium text-zinc-900 dark:text-white">{{ data_get($variable, 'name', 'Variable') }}</p>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ data_get($variable, 'env_variable', 'Unknown') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">No variables listed.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
