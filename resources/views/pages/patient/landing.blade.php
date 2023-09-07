@props([
    'entry' => null,
    'deadline' => 99,

    'title' => 'Landing Page',
    'logo' => '/logo.png',
    'favicon' => '/favicon.ico',

    'head' => '',
])
<!DOCTYPE html>
<html class="scroll-smooth" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">

    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $head }}
</head>

<body
    class="flex flex-col w-max-[100vw] min-h-screen overflow-auto text-black bg-gray-100 dark:text-white dark:bg-gray-900 transition-colors content-start">
    <header class="sticky top-0 z-[999]">
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center">
                    <img src="{{ config('dynamic.application.logo') }}" class="h-8 mr-3" alt="Flowbite Logo" />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ config('dynamic.application.name') }}</span>
                </a>
                <div class="flex md:order-1">
                    <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                        aria-expanded="false"
                        class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mr-1">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
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
                    <button data-collapse-toggle="navbar-search" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-search" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
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
                            <a href="#beranda"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                aria-current="page">Beranda</a>
                        </li>
                        <li>
                            <a href="#layanan"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Layanan</a>
                        </li>
                        <li>
                            <a href="#bidan"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Bidan</a>
                        </li>
                        @if ($user)
                            <li>
                                <a href="{{ route('web.patient.history') }}"
                                    class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 capitalize">{{ trans('history') }}</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('web.patient.login_show') }}"
                                class="flex gap-1.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                <img src="https://hhg-common.hellosehat.com/common/login.svg" alt=""> Masuk
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="grid">
        <section id="beranda"
            class="grid grid-cols-2 p-5 sm:px-20 bg-[url('https://hellosehat.com/images/homepage-banner/banner-bg.svg')] relative bg-cover bg-no-repeat">
            <div class="flex flex-col gap-5">
                <div class="font-bold text-3xl">
                    Layanan Homecare Untuk Ibu dan Anak
                </div>
                <div class="text-gray-700 text-base">
                    Layanan homecare dengan bidan berlisensi untuk melakukan pemeriksaan kehamilan dan perawatan bayi baru lahir
                </div>
                {{-- <button type="button"
                    class="text-white w-max h-max bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tanyakan
                    Sesuatu di Sini
                </button> --}}
            </div>
            <div class="flex justify-center">
                <div class="w-max bg-white rounded-lg p-5 pb-0 shadow-md shadow-stone-600">
                    <img class="h-[200px]" src="{{ asset('avatar1.png') }}" alt="">
                </div>
            </div>
        </section>

        <section id="layanan" class="@container px-2 sm:px-24 py-8">
            <div class="font-bold text-lg mb-3">Layanan Kami</div>
            <div
                class="grid @xs:grid-cols-2  @xs:grid-rows-3 @xl:grid-cols-3  @xl:grid-rows-2 @2xl:grid-cols-4 @2xl:grid-rows-2 @4xl:grid-cols-5 @4xl:grid-rows-1 gap-4">
                @foreach ($services as $service)
                    <div class="grid justify-items-center gap-2 p-2 bg-white shadow-lg rounded-xl">
                        <img class="" src="{{ asset('avatar2.png') }}" alt="">
                        <span class="text-center text-lg font-bold capitalize">
                            {{ $service->name }}
                        </span>
                    </div>
                @endforeach
            </div>
        </section>

        <div id="bidan" class="@container grid gap-2 px-2 sm:px-24 py-8">
            <div class="font-bold text-lg capitalize">Bidan Kami</div>
            <div class="grid @xs:grid-cols-1 @xl:grid-cols-2 @4xl:grid-cols-3 @6xl:grid-cols-4 gap-4">
                @foreach ($midwifes as $midwife)
                    <div class="flex gap-4 p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                        <img src="{{ $midwife->photo_url }}" alt="photo"
                            class="w-24 h-28 p-1 aspect-square object-cover border border-base-300 rounded">
                        <div class="flex flex-grow flex-col gap-4">
                            <div>
                                <div class="text-base font-medium capitalize">
                                    {{ $midwife->fullname }}
                                </div>
                                <div class="text-sm font-normal opacity-70 capitalize">
                                    {{ trans('midwife') }}
                                </div>
                                <div class="text-sm font-normal opacity-70 capitalize">
                                    {{ $midwife->srt }}
                                </div>
                            </div>
                            <a href="{{ route('web.patient.order.midwife', ['midwife' => $midwife]) }}"
                                class="w-fit px-3 py-1 self-end bg-primary text-primary-content text-sm font-medium capitalize rounded hover:bg-primary-focus">
                                {{ trans('service message') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
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
