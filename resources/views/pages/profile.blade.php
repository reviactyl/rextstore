@extends('layouts.app')

@section('title', $user->name . "'s Profile")

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-6">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-4">
                <div class="h-15 [&_img]:h-full [&_img]:rounded-full">
                    <x-avatar :email="$user->email" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                        {{ $user->name }}
                    </h1>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        {{ '@' . $user->username }}
                    </p>
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-500 dark:text-zinc-400">User ID</p>
                    <p class="mt-1 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $user->id }}</p>
                </div>

                <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Member Since</p>
                    <p class="mt-1 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $user->created_at?->format('M j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
