@props([
    'title' => 'signin',
    'action' => '',
    'for' => '',
    'data' => null,
    'demo' => false,
])
<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>{{ $title }}</title>

    <meta name="description" content="{{ $title }} Page">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#3b82f6">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="grid place-content-center min-h-screen bg-base-200">
    <form action="" method="post" class="grid p-8 w-96 bg-base-100 rounded-lg">
        <div class="grid gap-8">
            <div class="grid text-center">
                <div class="text-xl text-primary font-semibold">bladerlaiga</div>
                <div class="text-base-content/70 font-medium">Sign in to continue to App.</div>
            </div>
            <div class="flex flex-col gap-1">
                <label for="name" class="text-base text-base-content font-medium">
                    Username
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Username"
                    class="peer w-full px-4 py-2 bg-base-100 text-sm border-1 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
                @error('name')
                    <div class="text-sm text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </form>
</body>

</html>
