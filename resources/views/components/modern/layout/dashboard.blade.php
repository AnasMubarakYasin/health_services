@props(['title', 'head' => '', 'sidebar', 'topbar', 'main', 'bottom'])

<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/components/modern/layout/dashboard.js')

    {{ $head }}
    @yield('head')
</head>

<body>
    {{ $sidebar }}
    <section id="content" class="flex flex-col w-full h-screen max-xs:hidden relative bg-base-200 text-base-content"
        data-simplebar>
        {{ $topbar }}
        {{ $main }}
        {{ $bottom }}
    </section>
    {{ $slot }}
    <div class="max-xs:grid hidden place-content-center w-screen h-screen">
        <div>cannot under <span class="font-bold">320px</span> width</div>
    </div>
</body>

</html>
