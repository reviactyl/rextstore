@props([
    'icon' => null,
    'label'
])

<div class="relative" x-data="{ open: false }">

    <button 
        type="button" 
        @click="open = !open"
        class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white rounded-lg transition-colors"
    >
    @if($icon)
        <x-dynamic-component :component="$icon"  />
    @endif

        {{ $label }}

        <i class="fas fa-chevron-down text-xs transition-transform"
           :class="open ? 'rotate-180' : ''"></i>
    </button>

    <div 
        x-show="open"
        @click.outside="open = false"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
        class="absolute left-0 mt-2 w-56 z-50"
        x-cloak
    >
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg ring-1 ring-zinc-200 dark:ring-zinc-700 py-2">
            {{ $slot }}
        </div>
    </div>
</div>