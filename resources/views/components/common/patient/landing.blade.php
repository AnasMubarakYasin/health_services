@aware([
    'entry' => null,

    'title' => 'Landing Page',
    'description' => 'Landing Page',
    'logo' => '/logo.png',
    'favicon' => '/favicon.ico',

    'head' => '',
])
<!DOCTYPE html>
<html class="scroll-smooth max-sm:text-sm" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>{{ $title }}</title>

    <meta name="description" content="{{ $description }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/js/components/modern/app.js')
    @vite('resources/js/pages/patient/landing.js')

    {{ $head }}
</head>

<body
    class="flex flex-col w-max-[100vw] min-h-screen overflow-auto text-black bg-gray-100 dark:text-white dark:bg-gray-900 transition-colors content-start">
    <header class="sticky top-0 z-10">
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('web.patient.landing') }}" class="flex items-center">
                    <img src="{{ config('dynamic.application.logo') }}" class="h-8 mr-3" alt="Flowbite Logo" />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ config('dynamic.application.name') }}</span>
                </a>
                <div class="flex md:order-1">
                    {{-- <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                        aria-expanded="false"
                        class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mr-1">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button> --}}
                    {{-- <div class="relative hidden md:block">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search icon</span>
                        </div>
                        <input type="text" id="search-navbar"
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search...">
                    </div> --}}
                    @if ($panel && $panel->user)
                        <div class="contents md:hidden" data-te-dropdown-ref>
                            <button id="topbar_avatar" type="button" data-te-dropdown-toggle-ref aria-expanded="false"
                                data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                                data-te-placement="bottom" title="Avatar"
                                class="flex items-center w-10 h-10 rounded-full">
                                <img src="{{ $panel->get_user_photo() }}" alt="{{ $panel->get_user_name() }}"
                                    class="w-full h-full aspect-square object-cover rounded-full"
                                    onerror="this.style.display='none';this.nextElementSibling.style.display='grid'" />
                                <div class="hidden place-content-center w-full h-full opacity-70 hover:opacity-100">
                                    <x-icons.user class="w-6 h-6" stroke="2">

                                    </x-icons.user>
                                </div>
                            </button>
                            <ul aria-labelledby="topbar_avatar" data-te-dropdown-menu-ref
                                class="hidden flex-col absolute z-50 min-w-[240px] list-none overflow-hidden rounded-lg bg-base-100
                                [&[data-te-dropdown-show]]:flex shadow-all-lg
                                group-[#topbar&[data-card-type='elevated']]:group-[#topbar&[data-position='floated']]:shadow-all-lg
                                group-[#topbar&[data-card-type='bordered']]:border-2
                                group-[#topbar&[data-card-type='bordered']]:border-base-300
                                group-[#topbar&[data-card-type='bordered']]:group-[#topbar&[data-position='floated']]:border-2">
                                <li class="p-2">
                                    <a href="{{ route('web.patient.dashboard') }}"
                                        class="groupitem flex justify-start items-center gap-4 px-4 py-1 text-base-content hover:bg-primary hover:bg-opacity-10 hover:text-primary rounded-lg transition-colors">
                                        <img src="{{ $panel->get_user_photo() }}" alt="{{ $panel->get_user_name() }}"
                                            class="w-10 h-10 aspect-square object-cover
                                group-[#rounded-full"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='grid'" />
                                        <div class="hidden place-content-center w-10 h-10">
                                            <x-icons.user class="w-6 h-6" stroke="2">

                                            </x-icons.user>
                                        </div>
                                        <div class="flex flex-col justify-start content-between py-1">
                                            <div class="w-full font-semibold">
                                                {{ $panel->get_user_name() }}
                                            </div>
                                            <div class="w-full text-base-content text-opacity-70">
                                                {{ $panel->get_user_identifier() }}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="w-full h-[1px] bg-base-300">&ThinSpace;</li>
                                <li>
                                    <ul class="flex flex-col gap-2 py-2">
                                        @foreach ($panel->get_user_landing_menus() as $menu)

                                            @if ($menu->label)
                                                <li class="w-full h-[1px] bg-base-300">&ThinSpace;</li>
                                            @endif
                                            <li class="px-2">
                                                <a href="{{ $menu->link }}" data-te-dropdown-item-ref
                                                    class="flex justify-start items-center gap-4 px-4 py-2 hover:bg-primary hover:bg-opacity-10 text-base text-base-content hover:text-primary rounded-lg transition-colors">
                                                    {!! $menu->icon !!}
                                                    <div class="text-base font-medium capitalize">{{ $menu->name }}
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('web.patient.login_show') }}"
                            class="md:hidden flex gap-1.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm p-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                            aria-controls="navbar-search" aria-expanded="false">
                            <span class="sr-only">Masuk</span>
                            <img src="https://hhg-common.hellosehat.com/common/login.svg" alt="">
                        </a>
                    @endif
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-2" id="navbar-search">
                    <div class="relative mt-3 md:hidden">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="search-navbar"
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search...">
                    </div>
                    <ul
                        class="flex flex-col items-center p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="{{ route('web.patient.landing') }}#beranda"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                aria-current="page">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('web.patient.landing') }}#layanan"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Layanan</a>
                        </li>
                        <li>
                            <a href="{{ route('web.patient.landing') }}#bidan"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Bidan</a>
                        </li>
                        @if ($panel && $panel->user)
                            <li>
                                <a href="{{ route('web.patient.landing.history') }}"
                                    class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 capitalize">{{ trans('history') }}</a>
                            </li>
                        @endif
                        <li>
                            @if ($panel && $panel->user)
                                <div class="contents" data-te-dropdown-ref>
                                    <button id="topbar_avatar" type="button" data-te-dropdown-toggle-ref
                                        aria-expanded="false" data-te-ripple-init data-te-ripple-color="primary"
                                        data-te-toggle="tooltip" data-te-placement="bottom" title="Avatar"
                                        class="flex items-center w-10 h-10 rounded-full">
                                        <img src="{{ $panel->get_user_photo() }}"
                                            alt="{{ $panel->get_user_name() }}"
                                            class="w-full h-full aspect-square object-cover rounded-full"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='grid'" />
                                        <div
                                            class="hidden place-content-center w-full h-full opacity-70 hover:opacity-100">
                                            <x-icons.user class="w-6 h-6" stroke="2">

                                            </x-icons.user>
                                        </div>
                                    </button>
                                    <ul aria-labelledby="topbar_avatar" data-te-dropdown-menu-ref
                                        class="hidden flex-col absolute z-50 min-w-[240px] list-none overflow-hidden rounded-lg bg-base-100
                                [&[data-te-dropdown-show]]:flex shadow-all-lg
                                group-[#topbar&[data-card-type='elevated']]:group-[#topbar&[data-position='floated']]:shadow-all-lg
                                group-[#topbar&[data-card-type='bordered']]:border-2
                                group-[#topbar&[data-card-type='bordered']]:border-base-300
                                group-[#topbar&[data-card-type='bordered']]:group-[#topbar&[data-position='floated']]:border-2">
                                        <li class="p-2">
                                            <a href="{{ route('web.patient.dashboard') }}"
                                                class="groupitem flex justify-start items-center gap-4 px-4 py-1 text-base-content hover:bg-primary hover:bg-opacity-10 hover:text-primary rounded-lg transition-colors">
                                                <img src="{{ $panel->get_user_photo() }}"
                                                    alt="{{ $panel->get_user_name() }}"
                                                    class="w-10 h-10 aspect-square object-cover
                                            group-[#rounded-full"
                                                    onerror="this.style.display='none';this.nextElementSibling.style.display='grid'" />
                                                <div class="hidden place-content-center w-10 h-10">
                                                    <x-icons.user class="w-6 h-6" stroke="2">

                                                    </x-icons.user>
                                                </div>
                                                <div class="flex flex-col justify-start content-between py-1">
                                                    <div class="w-full font-semibold">
                                                        {{ $panel->get_user_name() }}
                                                    </div>
                                                    <div class="w-full text-base-content text-opacity-70">
                                                        {{ $panel->get_user_identifier() }}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="w-full h-[1px] bg-base-300">&ThinSpace;</li>
                                        <li>
                                            <ul class="flex flex-col gap-2 py-2">
                                                @foreach ($panel->get_user_landing_menus() as $menu)
                                                    @if ($menu->label)
                                                        <li class="w-full h-[1px] bg-base-300">&ThinSpace;</li>
                                                    @endif
                                                    <li class="px-2">
                                                        <a href="{{ $menu->link }}" data-te-dropdown-item-ref
                                                            class="flex justify-start items-center gap-4 px-4 py-2 hover:bg-primary hover:bg-opacity-10 text-base text-base-content hover:text-primary rounded-lg transition-colors">
                                                            {!! $menu->icon !!}
                                                            <div class="text-base font-medium capitalize">
                                                                {{ $menu->name }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ route('web.patient.login_show') }}"
                                    class="flex gap-1.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    <img src="https://hhg-common.hellosehat.com/common/login.svg" alt="">
                                    Masuk
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main class="grid">
        {{ $slot }}
    </main>

    <div class="flex-grow"></div>

    <footer class="bg-white shadow dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-10 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0">
                    <img src="{{ config('dynamic.application.logo') }}" class="h-8 mr-3" alt="Flowbite Logo" />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ config('dynamic.application.name') }}</span>
                </a>
                <ul
                    class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6 ">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">Copyright &copy;
                {{ config('dynamic.application.vendor_name') }}
                {{ config('dynamic.application.vendor_year') }}, All Right Reserved.</span>
        </div>
    </footer>

    <button id="backToTop"
        class="fixed bottom-3 right-3 bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full shadow">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
        </svg>
    </button>

    <script>
        const backToTopButton = document.getElementById("backToTop");

        backToTopButton.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });

        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove("hidden");
            } else {
                backToTopButton.classList.add("hidden");
            }
        });
    </script>

</body>

</html>
