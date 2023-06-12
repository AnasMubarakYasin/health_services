@props([
    'panel',

    'title' => 'Panel',
    'logo' => '/logo.png',
    'favicon' => '/favicon.ico',

    'head' => '',
    'topbar' => '',
    'sidebar' => '',
    'main' => '',
    'bottombar' => '',
])
<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', $panel->locale) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">

    <title>{{ trans($title) }}</title>

    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

    <script>
        var panel = @json($panel);
    </script>

    @vite('resources/js/components/simple/panel/progress.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/js/components/simple/app.js')
    @vite('resources/js/components/simple/panel/index.js')

    @if ($panel->webmanifest)
        <link rel="manifest" href="{{ $panel->get_webmanifest() }}">
    @endif
    @if ($panel->service_worker)
        <script type="module" src="{{ $panel->get_service_worker() }}"></script>
    @endif

    {{ $head }}
</head>

<body
    class="grid w-max-[100vw] min-h-screen overflow-hidden text-black bg-gray-100 dark:text-white dark:bg-gray-900 transition-colors content-start">
    <div class="flex min-h-screen">
        {{ $sidebar }}
        <div id="content" class="flex-grow grid h-screen grid-rows-[56px,auto,56px]">
            {{ $topbar }}
            <main class="overflow-auto">
                <div id="progress-bar"
                    class="sticky top-0 w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full transition-all">
                    <div class="max-w-full w-0 h-full bg-blue-600 dark:bg-blue-500 rounded-full ">
                    </div>
                </div>
                <div id="main" class="flex-grow overflow-auto">
                    {{ $main }}
                </div>
            </main>
            {{ $bottombar }}
        </div>
    </div>
    {{ $slot }}
</body>

</html>
