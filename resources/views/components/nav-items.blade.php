<x-nav-item
    :route="route('welcome')"
    icon="tabler-home-f"
    label="Home"
    :active="Route::currentRouteName() === 'welcome'" />

<x-nav-dropdown icon="tabler-packages" label="Products">

    <x-nav-item
        route="#"
        label="Eggs" />

    <x-nav-item
        route="#"
        label="Extensions" />

</x-nav-dropdown>