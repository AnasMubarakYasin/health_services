@aware(['panel', 'title'])
<div class="fixed top-0 right-0 w-full h-16 sm:h-20d max-xs:hidden backdrop-blur z-[1]"></div>
<header id="topbar"
    class="group flex items-center h-14 sm:h-16 px-4 gap-4 max-xs:hidden sticky top-0 bg-base-100 z-10 transition-all
        data-[card-type='elevated']:shadow-bottom
        sm:data-[card-type='elevated']:shadow-bottom-lg
        data-[card-type='elevated']:data-[position='floated']:shadow-all
        sm:data-[card-type='elevated']:data-[position='floated']:shadow-all-lg
        data-[card-type='bordered']:border-b-2
        data-[card-type='bordered']:border-base-300
        data-[card-type='bordered']:data-[position='floated']:border-2
        data-[position='floated']:m-4
        data-[position='floated']:top-4
        data-[position='floated']:rounded-xl"
    data-card-type="elevated" data-position="static" data-button-interface="ghosted" data-button-shape="rounded">
    {{-- <div class="absolute -top-14 sm:-top-16 -left-2 w-[calc(100%+1rem)] h-[calc(100%+1px)] max-xs:hidden backdrop-blur z-10"></div> --}}
    <div class="flex gap-2 items-center justify-start">
        <label role="button"
            class="grid place-items-center w-10 h-10 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg swap swap-rotate transition-colors
                group-[#topbar&[data-button-interface='filled']]:bg-base-200
                group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                group-[#topbar&[data-button-interface='outlined']]:border-2
                group-[#topbar&[data-button-interface='outlined']]:border-base-300
                group-[#topbar&[data-button-shape='circled']]:rounded-full"
            data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Toggle Theme">
            <input id="sidebar_toggle" type="checkbox" class="hidden" />
            <x-icons.menu class="swap-on fill-current w-5 h-5 sm:w-6 sm:h-6"></x-icons.menu>
            <x-icons.menu_slim class="swap-off fill-current w-5 h-5 sm:w-6 sm:h-6"></x-icons.menu_slim>
        </label>
    </div>
    <div class="flex-grow flex gap-2 items-center overflow-hidden">
        <h1
            class="hidden text-lg text-base-content font-medium transition-all
                group-[#topbar&[data-title='visible']]:block">
            {{ $title }}
        </h1>
    </div>
    <div class="flex gap-2 items-center justify-end">
        <div class="contents" data-te-dropdown-ref>
            <button id="btn_translate"
                class="grid place-items-center w-10 h-10 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg transition-colors
                    group-[#topbar&[data-button-interface='filled']]:bg-base-200
                    group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                    group-[#topbar&[data-button-interface='outlined']]:border-2
                    group-[#topbar&[data-button-interface='outlined']]:border-base-300
                    group-[#topbar&[data-button-shape='circled']]:rounded-full"
                type="button" aria-expanded="false" data-te-dropdown-toggle-ref data-te-ripple-init
                data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom" title="Translate">
                <x-icons.translate class="w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.translate>
            </button>
            <nav class="hidden flex-col min-w-[120px] absolute z-50 list-none overflow-hidden rounded-lg bg-base-100
                [&[data-te-dropdown-show]]:flex
                group-[#topbar&[data-card-type='elevated']]:shadow-all-lg
                group-[#topbar&[data-card-type='elevated']]:group-[#topbar&[data-position='floated']]:shadow-all-lg
                group-[#topbar&[data-card-type='bordered']]:border-2
                group-[#topbar&[data-card-type='bordered']]:border-base-300
                group-[#topbar&[data-card-type='bordered']]:group-[#topbar&[data-position='floated']]:border-2"
                aria-labelledby="btn_translate" data-te-dropdown-menu-ref>
                <ul class="flex flex-col gap-2 p-2">
                    @foreach ($panel::$locales as $key => $value)
                        <li>
                            <a href="{{ route('web.locale.set', ['locale' => $key]) }}" data-te-dropdown-item-ref
                                class="block px-4 py-2 text-base-content/70 font-medium hover:bg-base-200 hover:text-base-content/100 aria-selected:bg-primary aria-selected:text-primary-content/100 rounded-lg transition-colors capitalize"
                                aria-selected="{{ $key == $panel->locale ? 'true' : 'false' }}">
                                {{ $value }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div id="btn_theme_toggler" class="contents"></div>
        <div class="contents" data-te-dropdown-ref>
            <button id="btn_notification"
                class="grid place-items-center w-10 h-10 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg transition-colors
                    group-[#topbar&[data-button-interface='filled']]:bg-base-200
                    group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                    group-[#topbar&[data-button-interface='outlined']]:border-2
                    group-[#topbar&[data-button-interface='outlined']]:border-base-300
                    group-[#topbar&[data-button-shape='circled']]:rounded-full"
                type="button" aria-expanded="false" data-te-dropdown-toggle-ref data-te-ripple-init
                data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom" title="Notification">
                <x-icons.notification class="w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.notification>
            </button>
            <section
                class="hidden flex-col absolute z-50 min-w-[400px] list-none overflow-hidden rounded-lg bg-base-100
                [&[data-te-dropdown-show]]:flex
                group-[#topbar&[data-card-type='elevated']]:shadow-all-lg
                group-[#topbar&[data-card-type='elevated']]:group-[#topbar&[data-position='floated']]:shadow-all-lg
                group-[#topbar&[data-card-type='bordered']]:border-2
                group-[#topbar&[data-card-type='bordered']]:border-base-300
                group-[#topbar&[data-card-type='bordered']]:group-[#topbar&[data-position='floated']]:border-2"
                aria-labelledby="btn_notification" data-te-dropdown-menu-ref>
                <header class="p-4 text-center text-base-content/70 text-lg font-medium">
                    Notification
                </header>
                <main class="max-h-[40vh] overflow-auto border-y-2 border-base-300">
                    {{-- <div class="p-8 text-center text-base-content/50 text-base font-medium">
                    Empty
                </div> --}}
                    <ul class="">
                        @foreach (range(0, 10) as $_)
                            <li class="border-b-2 border-base-300">
                                <a href="" class="flex gap-4 items-start p-4 hover:bg-base-200"
                                    data-te-dropdown-item-ref>
                                    <img src="https://tecdn.b-cdn.net/img/new/avatars/2.webp" alt="Avatar"
                                        class="w-10
                                    group-[#topbar&[data-button-shape='rounded']]:rounded-lg
                                    group-[#topbar&[data-button-shape='circled']]:rounded-full" />
                                    <div class="flex flex-col gap-2">
                                        <div class="text-base-content font-medium">Congratulation Lettie</div>
                                        <div>
                                            <div class="text-base-content/70">
                                                Won the monthly best seller gold badge
                                            </div>
                                            <div class="text-base-content/50 text-sm">1h ago</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </main>
                <footer class="p-2">
                    <a data-te-ripple-init data-te-ripple-color="primary" data-te-dropdown-item-ref
                        href="/notification/all"
                        class="flex justify-center items-center w-full h-full p-2 text-primary/70 font-medium hover:bg-primary hover:bg-opacity-10 hover:text-primary rounded-lg transition-colors">
                        View All
                    </a>
                </footer>
            </section>
        </div>
        <label role="button"
            class="grid place-items-center w-10 h-10 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg swap swap-rotate transition-colors
                group-[#topbar&[data-button-interface='filled']]:bg-base-200
                group-[#topbar&[data-button-interface='filled']]:hover:bg-base-300
                group-[#topbar&[data-button-interface='outlined']]:border-2
                group-[#topbar&[data-button-interface='outlined']]:border-base-300
                group-[#topbar&[data-button-shape='circled']]:rounded-full"
            data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Toggle Theme">
            <input id="theme_toggle" type="checkbox" class="hidden" />
            <x-icons.light class="swap-on w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.light>
            <x-icons.dark class="swap-off w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.dark>
        </label>
        <div class="contents" data-te-dropdown-ref>
            <button id="topbar_avatar" type="button" data-te-dropdown-toggle-ref aria-expanded="false"
                data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom"
                title="Avatar"
                class="flex items-center w-10 h-10 group-[#topbar&[data-button-shape='rounded']]:rounded-lg group-[#topbar&[data-button-shape='circled']]:rounded-full">
                <img src="{{ $panel->get_user_photo() }}" alt="{{ $panel->get_user_name() }}"
                    class="group-[#topbar&[data-button-shape='rounded']]:rounded-lg group-[#topbar&[data-button-shape='circled']]:rounded-full" />
            </button>
            <ul aria-labelledby="topbar_avatar" data-te-dropdown-menu-ref
                class="hidden flex-col absolute z-50 min-w-[240px] list-none overflow-hidden rounded-lg bg-base-100
                    [&[data-te-dropdown-show]]:flex
                    group-[#topbar&[data-card-type='elevated']]:shadow-all-lg
                    group-[#topbar&[data-card-type='elevated']]:group-[#topbar&[data-position='floated']]:shadow-all-lg
                    group-[#topbar&[data-card-type='bordered']]:border-2
                    group-[#topbar&[data-card-type='bordered']]:border-base-300
                    group-[#topbar&[data-card-type='bordered']]:group-[#topbar&[data-position='floated']]:border-2">
                <li class="p-2">
                    <div
                        class="groupitem flex justify-start items-center gap-4 px-4 py-1 text-base-content hover:bg-primary hover:bg-opacity-10 hover:text-primary rounded-lg transition-colors">
                        <img src="{{ $panel->get_user_photo() }}" alt="{{ $panel->get_user_name() }}"
                            class="w-10 h-10
                                group-[#topbar&[data-button-shape='rounded']]:rounded-lg
                                group-[#topbar&[data-button-shape='circled']]:rounded-full" />
                        <div class="flex flex-col justify-start content-between py-1">
                            <div class="w-full font-semibold">
                                {{ $panel->get_user_name() }}
                            </div>
                            <div class="w-full text-base-content text-opacity-70">
                                {{ $panel->get_user_identifier() }}
                            </div>
                        </div>
                    </div>
                </li>
                <li class="w-full h-[1px] bg-base-300">&ThinSpace;</li>
                <li>
                    <ul class="flex flex-col gap-2 py-2">
                        @foreach ($panel->get_user_menus() as $menu)
                            @if ($menu->label)
                                <li class="w-full h-[1px] bg-base-300">&ThinSpace;</li>
                            @endif
                            <li class="px-2">
                                <a href="{{ $menu->link }}" data-te-dropdown-item-ref
                                    class="flex justify-start items-center gap-4 px-4 py-2 hover:bg-primary hover:bg-opacity-10 text-base text-base-content hover:text-primary rounded-lg transition-colors">
                                    {!! $menu->icon !!}
                                    <div class="text-base font-medium capitalize">{{ $menu->name }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                {{-- <li class="w-full h-[1px] bg-base-300">&ThinSpace;</li>
                <li class="p-2">
                    <div data-te-dropdown-item-ref
                        class="flex justify-start items-center gap-4 px-4 py-2 hover:bg-primary hover:bg-opacity-10 text-base text-base-content hover:text-primary rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        <div>SignOut</div>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</header>
