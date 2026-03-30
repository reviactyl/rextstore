@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-6">

    @if (session('success'))
    <div class="flex gap-3 rounded-xl border border-green-300 bg-green-50 dark:bg-green-950/30 dark:border-green-900 p-4">
        <div>
            <div class="font-medium text-green-700 dark:text-green-300">
                Success
            </div>
            <div class="text-sm text-green-600 dark:text-green-400 mt-1">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="flex gap-3 rounded-xl border border-red-300 bg-red-50 dark:bg-red-950/30 dark:border-red-900 p-4">
        <div>
            <div class="font-medium text-red-700 dark:text-red-300">
                Error
            </div>
            <div class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

<section data-rext-content>
    <div class="py-4 px-2 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-4">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-zinc-900 md:text-5xl lg:text-6xl dark:text-white">A Marketplace For <br /> <span class="text-blue-600">Reviactyl Extensions.</span></h1>
        <p class="mb-8 text-lg font-normal text-zinc-500 lg:text-xl sm:px-16 xl:px-48 dark:text-zinc-400">The First Official Marketplace for Reviactyl Extensions where developers can list their extensions @ no hidden fees.</p>
    </div>
</section>

<section data-rext-content class="py-4 md:py-8">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
      <h2 class="text-xl font-semibold text-zinc-900 dark:text-white sm:text-2xl">Browse by category</h2>

      <a href="#" title="" class="flex items-center text-base font-medium text-blue-700 hover:underline dark:text-blue-500">
        Browse all Products
        <x-tabler-arrow-narrow-right-dashed />
      </a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <a href="#" class="flex items-center rounded-lg border border-zinc-200 bg-white px-4 py-2 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700">
        <x-tabler-eggs class="me-2 h-4 w-4 shrink-0 text-zinc-900 dark:text-white" />
        <span class="ml-2 text-sm font-medium text-zinc-900 dark:text-white">Panel Eggs</span>
      </a>
      <a href="#" class="flex items-center rounded-lg border border-zinc-200 bg-white px-4 py-2 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700">
        <x-tabler-puzzle class="me-2 h-4 w-4 shrink-0 text-zinc-900 dark:text-white" />
        <span class="ml-2 text-sm font-medium text-zinc-900 dark:text-white">Panel Extensions</span>
      </a>
      <a href="#" class="flex items-center rounded-lg border border-zinc-200 bg-white px-4 py-2 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700">
        <x-tabler-cube class="me-2 h-4 w-4 shrink-0 text-zinc-900 dark:text-white" />
        <span class="ml-2 text-sm font-medium text-zinc-900 dark:text-white">Panel Releases</span>
      </a>
      <a href="#" class="flex items-center rounded-lg border border-zinc-200 bg-white px-4 py-2 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700">
        <x-tabler-anchor class="me-2 h-4 w-4 shrink-0 text-zinc-900 dark:text-white" />
        <span class="ml-2 text-sm font-medium text-zinc-900 dark:text-white">Wings Releases</span>
      </a>
      <a href="#" class="flex items-center rounded-lg border border-zinc-200 bg-white px-4 py-2 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700">
        <x-tabler-brand-docker class="me-2 h-4 w-4 shrink-0 text-zinc-900 dark:text-white" />
        <span class="ml-2 text-sm font-medium text-zinc-900 dark:text-white">Panel Images</span>
      </a>
      <a href="#" class="flex items-center rounded-lg border border-zinc-200 bg-white px-4 py-2 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700">
        <x-tabler-code class="me-2 h-4 w-4 shrink-0 text-zinc-900 dark:text-white" />
        <span class="ml-2 text-sm font-medium text-zinc-900 dark:text-white">Panel Scripts</span>
      </a>
    </div>
  </div>
</section>
</div>
@endsection
