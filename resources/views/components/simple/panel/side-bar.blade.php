@aware(['panel'])
@php
    $width = '300px';
@endphp
@mobile
    @php
        $width = '0px';
    @endphp
@endmobile
<aside id="drawer-main" class="bg-white dark:bg-gray-800 shadow transition-colors" tabindex="-1" style="flex: 0 0 {{ $width }};">
    <header
        class="flex gap-4 items-center justify-center sticky top-0 bg-white dark:bg-gray-800 text-xl font-semibold h-[56px] transition-colors">
        <div>
            <img src="{{ $panel->logo }}" alt="{{ $panel->name }}" class="w-8 h-8 rounded-md">
        </div>
        <div class="text-green-700 dark:text-green-500">
            {{ $panel->name }}
        </div>
    </header>
    <nav
        class="flex flex-col h-[calc(100vh_-_56px)] p-4 overflow-auto bg-white dark:bg-gray-800 shadow transition-colors">
        <x-simple.panel.side-bar-menus :id="'side-bar-menus'" :menus="$panel->get_menus()">

        </x-simple.panel.side-bar-menus>
        <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700 capitalize">
            <li>
                <a href="{{ $panel->signout() }}" @class([
                    'flex items-center p-2 text-base font-normal rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700',
                ])>
                    <svg @class(['w-6 h-6 transition text-gray-700 dark:text-white']) xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <span class="ml-3">Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
