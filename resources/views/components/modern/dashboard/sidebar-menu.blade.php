@props(['menu'])

@if (!$menu->submenu)
    <li class="">
        <a href="{{ $menu->link }}" data-te-ripple-init data-te-ripple-color="light" data-te-sidenav-link-ref
            class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary/30 text-base-content/60 hover:text-base-content/100
        data-[te-sidebar-state-active]:text-opacity-100
        group-[#sidebar&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:bg-primary
        group-[#sidebar&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:text-primary-content
        group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-l-4
        group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-primary
        group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:text-primary
        group-[#sidebar&[data-menu-type='rounded']]:rounded-lg
        group-[#sidebar&[data-menu-type='rectangled']]:py-4
        transition-all">
            <div>
                {!! $menu->icon !!}
            </div>
            <div data-te-sidenav-slim="false" class="flex-grow font-medium capitalize">
                {{ $menu->name }}
            </div>
        </a>
    </li>
@else
    <li class="flex flex-col gap-1">
        <a hhref="{{ $menu->link }}" data-te-ripple-init data-te-ripple-color="light" data-te-sidenav-link-ref
            data-te-collapse-init data-te-collapse-collapsed
            class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 focus:bg-base-300 text-base-content/60 hover:text-base-content/100
    group-[#sidebar&[data-menu-type='rounded']]:data-[te-sidenav-state-active]:bg-base-200
    group-[#sidebar&[data-menu-type='rounded']]:data-[te-sidenav-state-active]:text-base-content/100
    group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidenav-state-active]:text-primary
    group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidenav-state-active]:aria-expanded:text-primary/100
    group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidenav-state-active]:aria-expanded:bg-base-100
    group-[#sidebar&[data-menu-type='rectangled']]:aria-expanded:bg-base-300
    group-[#sidebar&[data-menu-type='rectangled']]:aria-expanded:text-base-content/100
    group-[#sidebar&[data-menu-type='rounded']]:rounded-lg
    group-[#sidebar&[data-menu-type='rectangled']]:py-4
    transition-colors">
            <div>
                {!! $menu->icon !!}
            </div>
            <div data-te-sidenav-slim="false" class="flex-grow font-medium capitalize">
                {{ $menu->name }}
            </div>
            <div data-te-sidenav-slim="false" data-te-sidenav-rotate-icon-ref class="transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </a>
        <ul class="!visible hidden list-none data-[te-collapse-show]:flex flex-col gap-1" data-te-sidenav-collapse-ref>
            @foreach ($menu->submenu as $submenu)
                <li class="">
                    <a href="{{ $submenu->link }}" data-te-ripple-init data-te-ripple-color="light"
                        data-te-sidenav-link-ref
                        class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary/30 text-base-content/60 hover:text-base-content/100
                data-[te-sidebar-state-active]:text-opacity-100
                group-[#sidebar&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:bg-primary
                group-[#sidebar&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:text-primary-content
                group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-l-4
                group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-primary
                group-[#sidebar&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:text-primary
                group-[#sidebar&[data-menu-type='rounded']]:rounded-lg
                group-[#sidebar&[data-menu-type='rectangled']]:py-4
                transition-all">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                            </svg>
                        </div>
                        <div class="flex-grow font-normal">
                            {{ $submenu->name }}
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif
