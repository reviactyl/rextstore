@props([
    'route' => '#',
    'icon' => null,
    'label',
    'active' => false
])

<a href="{{ $route }}"
   class="flex items-center gap-2 px-4 py-2 text-sm rounded-lg transition-colors
   {{ $active
        ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white'
        : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700 hover:text-zinc-900 dark:hover:text-white'
   }}">
    
    @if($icon)
        <x-dynamic-component :component="$icon"  />
    @endif

    {{ $label }}
</a>