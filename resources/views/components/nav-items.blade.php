<x-nav-item
    :route="route('home')"
    icon="tabler-home-f"
    label="Home"
    :active="Route::currentRouteName() === 'home'" />

<x-nav-item
    :route="route('eggs.index')"
    icon="tabler-eggs"
    label="Eggs"
    :active="Route::is('eggs.*')" />

<x-nav-dropdown icon="tabler-packages" label="Products">

    <x-nav-item
        :route="route('eggs.index')"
        label="Eggs"
        :active="Route::is('eggs.*')" />

    <x-nav-item
        route="#"
        label="Extensions" />

</x-nav-dropdown>
