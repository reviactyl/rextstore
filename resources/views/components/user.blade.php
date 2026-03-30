<div class="relative" x-data="{ open: false }">
    <button 
        type="button"
        @click="open = !open"
        class="flex items-center gap-2 p-1 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-full transition-colors"
    >
        <div class="h-10 [&_img]:h-full [&_img]:rounded-full">
            <x-avatar :email="auth()->user()->email" />
        </div>
    </button>
    <div 
        x-show="open"
        @click.outside="open = false"
        x-transition
        x-cloak
        class="absolute right-0 mt-2 w-56 z-50"
    >
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg ring-1 ring-zinc-200 dark:ring-zinc-700 py-2">

            <div class="px-4 py-2">
                <h4 class="text-sm font-semibold text-zinc-900 dark:text-white text-center">
                    {{ auth()->user()->name }}
                </h4>
            </div>
            <div class="my-1 border-t border-zinc-200 dark:border-zinc-700"></div>
            <div class="py-1">

                <a href="{{ route('profile', ['user' => auth()->user()]) }}"
                   class="flex items-center gap-2 px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700">
                    <i class="fas fa-user"></i>
                    Profile
                </a>

                <a href="#"
                   class="flex items-center gap-2 px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>

                <div class="my-1 border-t border-zinc-200 dark:border-zinc-700"></div>
                @csrf
                <form method="POST" action="{{ route('logout') }}">
                <button type="submit"
                   class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 text-left">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
                </form>

            </div>

        </div>
    </div>
</div>