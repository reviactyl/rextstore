<div x-data="{ sidebarOpen: false }">

<div id="mobile-sidebar" class="fixed inset-0 z-50" x-show="sidebarOpen" x-cloak>
   
   <div class="fixed inset-0 bg-zinc-900/50 dark:bg-zinc-950/50" @click="sidebarOpen = false"></div>
   
   <div class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-zinc-900 shadow-xl transform transition-transform duration-300 ease-in-out"
      :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
      <div class="flex flex-col h-full">
         
         <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 dark:border-zinc-800">
            <x-logo />
            <button type="button" @click="sidebarOpen = false"
            class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
            <x-tabler-clear-all />
            </button>
         </div>
         
         <nav class="flex-1 overflow-y-auto px-3 py-4">
            <x-nav-items />
         </nav>
      </div>
   </div>
</div>

<nav class="sticky top-0 z-40 bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800 shadow-sm">
   <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
         
         <div class="flex items-center gap-6">
            
            <button type="button" @click="sidebarOpen = true"
            class="lg:hidden text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
            <x-tabler-menu-3 />
            </button>
            
            <div class="hidden lg:block">
               <x-logo />
            </div>
            
            <div class="hidden lg:flex items-center gap-1">
               <x-nav-items />
            </div>
         </div>
         <div class="flex items-center gap-2">
            @auth
            <x-user />
            @else
            <a href="{{ route('login') }}"
               class="px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 rounded-lg transition-colors">
            Login
            </a>

            <a href="{{ route('register') }}"
               class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors">
            Register
            </a>
            @endauth
         </div>
      </div>
   </div>
</nav>

</div>