@aware(['panel'])
<aside id="sidebar"
    class="group h-screen max-xs:hidden bg-base-100 text-base-content z-10
        data-[card-type='elevated']:shadow-right
        lg:data-[card-type='elevated']:shadow-right-lg
        data-[card-type='bordered']:border-r-2
        data-[card-type='bordered']:border-base-300"
    data-sidebar data-header-position="center" data-card-type="elevated"
    data-menu-type="rounded">
    <header
        class="flex gap-4 items-center sticky top-0 h-16 text-xl transition-colors
            group-[#sidebar&[data-header-position='center']]:justify-center
            group-[#sidebar&[data-header-position='left']]:justify-left
            group-[#sidebar&[data-header-position='left']]:pl-4">
        <div>
            <div class="relative" data-te-dropdown-ref>
                <img src="{{ asset('logo.png') }}" alt="Bladerlaiga" class="w-10 h-10 rounded-md">
            </div>
        </div>
        <div class="font-semibold text-2xl text-primary" data-te-sidenav-slim="false">
            {{ 'Application' }}
        </div>
    </header>
    <nav>
        <ul data-te-sidenav-menu-ref
            class="flex flex-col gap-3 list-none
                group-[#sidebar&[data-menu-type='rounded']]:p-4
                group-[#sidebar&[data-menu-type='rectangled']]:py-4">
            @foreach ($panel->get_menus() as $menu)
                <x-modern.dashboard.sidebar-menu :menu="$menu" />
            @endforeach
        </ul>
    </nav>
</aside>
