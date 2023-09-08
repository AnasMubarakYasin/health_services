@aware(['panel'])
@props(['title' => 'Panel', 'logo' => '/logo.png', 'favicon' => '/favicon.ico', 'head' => '', 'sidebar' => '', 'topbar' => '', 'main' => '', 'bottombar' => ''])

<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

    <title>{{ $title }}</title>

    <script>
        var panel = @json($panel);
        var errors = {};
        @env('local')
            errors = @json($errors->getBags());
        @endenv
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/js/components/modern/common/progress.js')
    @vite('resources/js/components/common/bg-gen.js')
    @vite('resources/js/components/modern/app.js')
    @vite('resources/js/components/modern/layout/dashboard.js')

    @if ($panel->webmanifest)
        <link rel="manifest" href="{{ $panel->get_webmanifest() }}">
    @endif
    @if ($panel->service_worker)
        <script type="module" src="{{ $panel->get_service_worker() }}"></script>
    @endif

    {{ $head }}
    @yield('head')
</head>

{{-- <body class="opacity-0 transition-opacity bg-base-200 text-base-content"> --}}

<body class="bg-base-200 text-base-content">
    <x-modern.common.progress></x-modern.common.progress>
    {{ $sidebar }}
    <section id="content" class="flex flex-col w-full min-h-screen max-xs:hidden relative">
        {{ $topbar }}
        {{ $main }}
        {{ $bottombar }}
    </section>
    {{ $slot }}
    <div class="max-xs:grid hidden place-content-center w-screen h-screen">
        <div>cannot under <span class="font-bold">320px</span> width</div>
    </div>
</body>

</html>
