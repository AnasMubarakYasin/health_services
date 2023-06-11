<aside {{ $attributes->merge(['id' => '']) }}
    class="group/sidebar h-screen bg-base-100 text-base-content z-10
        data-[surface-type='elevated']:shadow-right
        lg:data-[surface-type='elevated']:shadow-right-lg
        data-[surface-type='bordered']:border-r-2
        data-[surface-type='bordered']:border-base-300"
    data-sidebar data-sidebar-width="280" data-header-position="center" data-surface-type="elevated" data-menu-type="rounded">
    {{ $slot }}
    {{-- <header
        class="flex gap-4 items-center sticky top-0 h-16 text-xl transition-colors
            group-[&[data-header-position='center']]:justify-center
            group-[&[data-header-position='left']]:justify-left
            group-[&[data-header-position='left']]:pl-4">
        <div>
            <div class="relative" data-te-dropdown-ref>
                <img src="{{ asset('logo.png') }}" alt="Bladerlaiga" class="w-10 h-10 rounded-md">
            </div>
        </div>
        <div class="font-semibold text-2xl text-primary" data-te-sidenav-slim="false">
            {{ 'Application' }}
        </div>
    </header> --}}
    {{-- <nav>
        <ul data-te-sidenav-menu-ref
            class="flex flex-col gap-3 list-none
            group-[&[data-menu-type='rounded']]:p-4
            group-[&[data-menu-type='rectangled']]:py-4">
            <li class="">
                <a href="/"
                    class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary/30 text-base-content/60 hover:text-base-content/100
                    data-[te-sidebar-state-active]:text-opacity-100
                    group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:bg-primary
                    group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:text-primary-content
                    group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-l-4
                    group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-primary
                    group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:text-primary
                    group-[&[data-menu-type='rounded']]:rounded-lg
                    group-[&[data-menu-type='rectangled']]:py-4
                    transition-all"
                    data-te-ripple-init data-te-ripple-color="light" data-te-sidenav-link-ref>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <div data-te-sidenav-slim="false" class="flex-grow font-medium">Dashboard</div>
                </a>
            </li>
            <li class="flex flex-col gap-1">
                <div type="button"
                    class="px-2 text-sm font-medium text-base-content text-opacity-50 group-[&[data-expanded='false']]:hidden uppercase">
                    resource
                </div>
                <div class="w-full flex justify-center opacity-70 hover:bg-base-200 group-[&[data-expanded='true']]:hidden"
                    data-te-toggle="tooltip" data-te-placement="right" title="resource">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </div>
                <a href="/resource" data-te-ripple-init data-te-ripple-color="light" data-te-sidenav-link-ref
                    data-te-collapse-init data-te-collapse-collapsed
                    class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 focus:bg-base-300 text-base-content/60 hover:text-opacity-100
                    group-[&[data-menu-type='rounded']]:data-[te-sidenav-state-active]:bg-base-300
                    group-[&[data-menu-type='rounded']]:data-[te-sidenav-state-active]:text-base-content/100
                    group-[&[data-menu-type='rectangled']]:data-[te-sidenav-state-active]:text-primary
                    group-[&[data-menu-type='rectangled']]:data-[te-sidenav-state-active]:aria-expanded:text-primary/100
                    group-[&[data-menu-type='rectangled']]:data-[te-sidenav-state-active]:aria-expanded:bg-base-100
                    group-[&[data-menu-type='rectangled']]:aria-expanded:bg-base-300
                    group-[&[data-menu-type='rectangled']]:aria-expanded:text-base-content/100
                    group-[&[data-menu-type='rounded']]:rounded-lg
                    group-[&[data-menu-type='rectangled']]:py-4
                    transition-colors">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div data-te-sidenav-slim="false" class="flex-grow font-medium">Users</div>
                    <div data-te-sidenav-slim="false" data-te-sidenav-rotate-icon-ref class="transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </a>
                <ul class="!visible hidden list-none data-[te-collapse-show]:flex flex-col gap-1"
                    data-te-sidenav-collapse-ref>
                    <li class="">
                        <a href="/resource/administrator" data-te-ripple-init data-te-ripple-color="light"
                            data-te-sidenav-link-ref
                            class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary active:bg-opacity-30 text-base-content text-opacity-60 hover:text-opacity-100
                            data-[te-sidebar-state-active]:text-opacity-100
                            group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:bg-primary
                            group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:text-primary-content
                            group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-l-4
                            group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-primary
                            group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:text-primary
                            group-[&[data-menu-type='rounded']]:rounded-lg
                            group-[&[data-menu-type='rectangled']]:py-4
                            transition-all">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </div>
                            <div class="flex-grow font-normal">
                                administrator
                            </div>
                        </a>
                    </li>
                    <li class="">
                        <a href="/resource/user" data-te-ripple-init data-te-ripple-color="light"
                            data-te-sidenav-link-ref
                            class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary active:bg-opacity-30 text-base-content text-opacity-60 hover:text-opacity-100
                            data-[te-sidebar-state-active]:text-opacity-100
                            group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:bg-primary
                            group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:text-primary-content
                            group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-l-4
                            group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-primary
                            group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:text-primary
                            group-[&[data-menu-type='rounded']]:rounded-lg
                            group-[&[data-menu-type='rectangled']]:py-4
                            transition-all">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </div>
                            <div class="flex-grow font-normal">
                                user
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="/resource/trash"
                    class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary/30 text-base-content/60 hover:text-base-content/100
                    data-[te-sidebar-state-active]:text-opacity-100
                    group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:bg-primary
                    group-[&[data-menu-type='rounded']]:data-[te-sidebar-state-active]:text-primary-content
                    group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-l-4
                    group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:border-primary
                    group-[&[data-menu-type='rectangled']]:data-[te-sidebar-state-active]:text-primary
                    group-[&[data-menu-type='rounded']]:rounded-lg
                    group-[&[data-menu-type='rectangled']]:py-4
                    transition-all"
                    data-te-ripple-init data-te-ripple-color="light" data-te-sidenav-link-ref>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                    <div data-te-sidenav-slim="false" class="flex-grow font-medium">trash</div>
                </a>
            </li>
            <li class="flex flex-col gap-1">
                <div type="button"
                    class="px-2 text-sm font-medium text-base-content text-opacity-50 group-[&[data-expanded='false']]:hidden uppercase">
                    system
                </div>
                <div class="w-full flex justify-center opacity-70 hover:bg-base-200 group-[&[data-expanded='true']]:hidden"
                    data-te-toggle="tooltip" data-te-placement="right" title="system">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </div>
                <ul data-te-sidenav-menu-ref class="flex flex-col gap-2 list-none">
                    <li class="">
                        <a href="/system/command" data-te-ripple-init data-te-ripple-color="light"
                            data-te-sidenav-link-ref
                            class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary active:bg-opacity-30 focus:bg-primary text-base-content text-opacity-60 hover:text-opacity-100 focus:text-primary-content data-[te-sidenav-state-active]:bg-primary data-[te-sidenav-state-active]:text-primary-content data-[te-sidenav-state-active]:text-opacity-100 data-[te-sidenav-state-focus]:outline-none transition-all rounded-md">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <div data-te-sidenav-slim="false" class="flex-grow font-medium">Command</div>
                        </a>
                    </li>
                    <li class="">
                        <a href="/service/file_manager" data-te-ripple-init data-te-ripple-color="light"
                            data-te-sidenav-link-ref
                            class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary active:bg-opacity-30 focus:bg-primary text-base-content text-opacity-60 hover:text-opacity-100 focus:text-primary-content data-[te-sidenav-state-active]:bg-primary data-[te-sidenav-state-active]:text-primary-content data-[te-sidenav-state-active]:text-opacity-100 data-[te-sidenav-state-focus]:outline-none transition-all rounded-md">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                </svg>
                            </div>
                            <div data-te-sidenav-slim="false" class="flex-grow font-medium">File Manager</div>
                        </a>
                    </li>
                    <li class="">
                        <a href="/service/log" data-te-ripple-init data-te-ripple-color="light"
                            data-te-sidenav-link-ref
                            class="flex justify-center items-center gap-4 px-4 py-3 hover:bg-base-200 active:bg-primary active:bg-opacity-30 focus:bg-primary text-base-content text-opacity-60 hover:text-opacity-100 focus:text-primary-content data-[te-sidenav-state-active]:bg-primary data-[te-sidenav-state-active]:text-primary-content data-[te-sidenav-state-active]:text-opacity-100 data-[te-sidenav-state-focus]:outline-none transition-all rounded-md">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div data-te-sidenav-slim="false" class="flex-grow font-medium">Log</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav> --}}
</aside>
