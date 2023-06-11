@props([
    'entry' => null,
    'deadline' => 99,

    'title' => 'Entry',
    'logo' => '/logo.png',
    'favicon' => '/favicon.ico',

    'head' => '',
])
<!DOCTYPE html>
<html>

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
    <header
        class="flex gap-4 items-center p-4 sm:px-20 bg-gray-100 dark:bg-gray-800 text-3xl font-semibold transition-colors">
        <div>
            <img src="{{ config('dynamic.application.vendor_logo') }}"
                alt="{{ config('dynamic.application.vendor_name') }}" class="w-8 h-8 rounded-md">
        </div>
        <div class="text-green-700 dark:text-green-500">
            {{ config('dynamic.application.vendor_name') }}
        </div>
        <div class="text-sm self-end text-gray-700 dark:text-gray-500">
            v{{ config('dynamic.application.vendor_version') }}
        </div>
    </header>
    <main class="grid g-4 p-4 sm:py-8 sm:px-20">
        @if (!$done)
            <div class="">
                @if ($deadline == 7)
                    <div class="p-4 m-auto bg-yellow-300 text-slate-950 text-xl w-[480px] rounded-lg">
                        Hanya Mengingatkan <span class="font-bold">Deadline</span> tinggal <span
                            class="font-bold">{{ $deadline }}</span> hari. <br>
                        <span class="text-base">Santuy Dulu.</span>
                    </div>
                @elseif ($deadline == 3)
                    <div class="p-4 m-auto bg-red-500 text-slate-950 text-xl w-[480px] rounded-lg">
                        Hei <span class="font-bold">Deadline</span> tinggal <span
                            class="font-bold">{{ $deadline }}</span> hari. <br>
                        <span class="text-base">Kerjami Cepat.</span>
                    </div>
                @elseif ($deadline == 1)
                    <div class="p-4 m-auto bg-purple-500 text-slate-950 text-xl w-[480px] rounded-lg">
                        Kodong Besokmi. <br>
                        <span class="text-base">Jangan lupa tidur.</span>
                    </div>
                @elseif ($deadline == 0)
                    <div class="p-4 m-auto bg-purple-950 text-slate-50 text-xl w-[480px] rounded-lg">
                        Oi Deadline mi... <br>
                        <span class="text-base">Kasi Selesaimi.</span>
                    </div>
                @else
                @endif
            </div>
        @endif
        <section class="grid gap-8">
            <section class="flex flex-col gap-4">
                <div class="text-xl font-semibold text-gray-800">
                    Information
                </div>
                <div class="p-4 flex flex-col gap-2 bg-white dark:bg-gray-800 rounded-lg shadow transition-colors">
                    <div class="flex flex-col gap-1">
                        <div class="text-base font-medium text-gray-600">
                            App Name
                        </div>
                        <div class="text-base font-normal text-black">
                            {{ config('dynamic.application.name') }}
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-col gap-1">
                        <div class="text-base font-medium text-gray-600">
                            App Version
                        </div>
                        <div class="text-base font-normal text-black">
                            {{ config('dynamic.application.version') }}
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-col gap-2">
                        <div class="text-base font-medium text-gray-600">
                            App Date
                        </div>
                        <div class="w-max text-base font-normal text-black">
                            <div class="grid grid-cols-[min-content_auto] grid-rows-2 gap-x-2">
                                <div>Inited:</div>
                                <div>{{ $entry->updates->date_inited }}</div>
                                <div>Updated:</div>
                                <div>{{ $entry->updates->date_updated }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-col gap-2">
                        <div class="text-base font-medium text-gray-600">
                            App Deployment
                        </div>
                        <div class="text-base font-normal text-black">

                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-col gap-2">
                        <div class="text-base font-medium text-gray-600">
                            App Changelog
                        </div>
                        <div class="text-base font-normal text-black">
                            <details>
                                <summary>Show</summary>
                                <pre class="text-sm">
                                    {{ "\n" . $entry->updates->changes }}
                                </pre>
                            </details>
                        </div>
                    </div>
                </div>
            </section>
            <section class="flex flex-col gap-4">
                <div class="text-xl font-semibold text-gray-800">
                    Users
                </div>
                <div class="flex flex-wrap gap-4">
                    @foreach ($entry->get_users() as $user)
                        @isset($user['account'])
                            <div
                                class="grid content-start w-[200px] gap-2 py-2 bg-white dark:bg-gray-800 rounded-lg shadow transition-colors">
                                <div class="px-4 flex items-center gap-2 text-lg font-bold text-gray-900">
                                    {{-- <div class="p-1 ">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div> --}}
                                    <div>
                                        {{ $user['name'] }}
                                    </div>
                                </div>
                                <hr>
                                {{-- <div class="px-4 py-2"></div> --}}
                                <nav class="px-4 text-right">
                                    <a href="{{ $user['entry'] . (isset($user['demo']) ? '?demo=true' : '') }}"
                                        class="text-blue-500 font-semibold hover:underline">Visit</a>
                                </nav>
                            </div>
                        @else
                            <div
                                class="grid w-[200px] gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow hover:bg-gray-50 transition-colors">
                                <div class="grid place-content-center aspect-square bg-gray-200 p-2 rounded-lg">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="grid gap-4">
                                    <div class="text-base font-medium text-gray-900">
                                        {{ $user['name'] }}
                                    </div>
                                    <div class="grid gap-2">
                                        @foreach ($user['accounts'] as $item)
                                            <a href="{{ $user['login'] . (isset($user['demo']) ? '?demo=true&role=' . $item['role'] : '?role=' . $item['role']) }}"
                                                class="text-sm font-medium text-gray-700 hover:text-gray-800">
                                                {{ $item['role'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endisset
                    @endforeach
                </div>
            </section>
            <section class="flex flex-col gap-4">
                <div class="text-xl font-semibold text-gray-800">
                    Templates
                </div>
                <div class="flex flex-wrap gap-4">
                    @foreach ($entry->config['templates'] as $template)
                        <div
                            class="grid content-start w-[400px] gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow transition-colors">
                            <div class="grid place-content-center bg-gray-200 p-2 rounded-lg">
                                <img src="{{ $template['thumb'] }}" alt="">
                            </div>
                            <div class="text-lg text-center font-bold text-gray-900">
                                {{ $template['name'] }} v{{ $template['version'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </section>
        {{ $slot }}
    </main>
    <div class="flex-grow"></div>
    <footer
        class="sticky bottom-0 flex items-center justify-center h-[56px] bg-white dark:bg-gray-800 shadow transition-colors">
        <div class="text-sm">
            Copyright &copy; {{ config('dynamic.application.vendor_name') }}
            {{ config('dynamic.application.vendor_year') }}, All Right Reserved.
        </div>
    </footer>

</body>

</html>
