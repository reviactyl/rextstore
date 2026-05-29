@extends('layouts.app')

@section('title', 'Eggs')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Nests</p>
            <h1 class="mt-1 text-3xl font-bold text-zinc-900 dark:text-white">Egg Overview</h1>
            <p class="mt-2 max-w-2xl text-sm text-zinc-600 dark:text-zinc-400">
                Browse {{ $data['available_eggs'] ?? 0 }} eggs across {{ $data['available_nests'] ?? 0 }} nests.
            </p>
        </div>
    </div>

    <div class="mb-8">
        <div class="mb-3 flex items-center gap-2 text-sm font-semibold text-zinc-900 dark:text-white">
            <x-tabler-filter class="h-4 w-4" />
            Filters
        </div>

        <div class="flex flex-wrap gap-2">
            <a
                href="{{ route('eggs.index') }}"
                class="rounded-lg border px-4 py-2 text-sm font-medium transition-colors {{ blank($selectedNest) ? 'border-blue-600 bg-blue-600 text-white' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-700' }}"
            >
                All
            </a>

            @foreach ($nests as $nestName => $nest)
                <a
                    href="{{ route('eggs.index', ['nest' => $nestName]) }}"
                    class="rounded-lg border px-4 py-2 text-sm font-medium transition-colors {{ $selectedNest === $nestName ? 'border-blue-600 bg-blue-600 text-white' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-700' }}"
                >
                    {{ str($nestName)->replace('-', ' ')->title() }}
                    <span class="ml-1 text-xs opacity-75">{{ $nest['egg_counts'] ?? 0 }}</span>
                </a>
            @endforeach
        </div>

        <a href="https://github.com/reviactyl/eggs" class="mt-3 flex items-center gap-2 text-sm font-semibold text-zinc-900 dark:text-white">
            <x-tabler-brand-github class="h-4 w-4" />
            Edit on GitHub
        </a>
    </div>

    @if ($eggs->isEmpty())
        <div class="rounded-lg border border-zinc-200 bg-white p-8 text-center dark:border-zinc-800 dark:bg-zinc-900">
            <p class="text-sm text-zinc-600 dark:text-zinc-400">No eggs found for this nest.</p>
        </div>
    @else
        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($eggs as $egg)
                <a
                    href="{{ route('eggs.show', ['nest' => $egg['nest'], 'egg' => $egg['slug']]) }}"
                    class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 transition hover:border-blue-300 hover:bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-blue-700 dark:hover:bg-zinc-800"
                >
                
                        @if ($egg['image'])
                            <img src="{{ $egg['image'] }}" alt="{{ $egg['name'] }}" class="absolute right-4 top-1/2 -translate-y-1/2 h-[120px] w-[120px] opacity-20 pointer-events-none select-none">
                        @else
                            <x-tabler-eggs class="h-8 w-8 text-zinc-400" />
                        @endif

                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-block text-[10px] px-2 py-0.5 rounded-full mt-1 border transition hover:brightness-110 cursor-pointer text-blue-300 border-blue-500 bg-blue-500/20">
                                {{ str($egg['nest'])->replace('-', ' ')->title() }}
                            </span>
                            @if ($egg['author'])
                                <span class="truncate text-xs text-zinc-500 dark:text-zinc-400">{{ $egg['author'] }}</span> @if ($egg['author'] == 'authors@reviactyl.app') <x-tabler-circle-check class="text-blue-500" /> @endif
                            @endif
                        </div>

                        <h2 class="mt-2 truncate text-2xl font-bold text-zinc-900 group-hover:text-blue-700 dark:text-white dark:group-hover:text-blue-400">
                            {{ $egg['name'] }}
                        </h2>
                        <p class="mt-1 line-clamp-2 text-sm text-zinc-600 dark:text-zinc-400">
                            {{ $egg['description'] ?: 'Someone ate our description ;(' }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $eggs->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>
@endsection
