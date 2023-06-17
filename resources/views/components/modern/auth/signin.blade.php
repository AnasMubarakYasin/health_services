@props([
    'title' => 'signin',
    'description' => 'signin page',
    'action' => '',
    'user' => '',
    'data' => [],
    'demo' => false,
    'register' => '',
    'head' => '',
])
<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

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
    <meta name="theme-color" content="#3b82f6">

    @vite('resources/js/components/common/error-boundary.js')
    @vite('resources/js/components/common/bg-gen.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $head }}
</head>

<body class="grid place-content-center gap-8 min-h-screen bg-base-200">
    <form action="{{ $action }}" method="post"
        class="relative grid gap-8 p-8 m-8 w-96 z-10 bg-base-100 rounded-lg shadow-lg">
        @csrf
        @if ($demo)
            <div class="absolute top-2 left-2 z-10 grid place-content-center">
                <div class="px-3 py-1 text-sm font-semibold bg-primary text-primary-content rounded-full">Demo</div>
            </div>
        @endif
        <div class="grid text-center pb-6">
            <div class="text-2xl text-primary font-semibold capitalize">bladerlaiga</div>
            <div class="text-base-content/70 font-medium">Sign In to continue App.</div>
        </div>
        <div class="grid gap-4">
            <div class="flex flex-col gap-1">
                <label for="name" class="text-base text-base-content font-medium">
                    Username
                </label>
                <input id="name" name="name" value="{{ old('name', $data['name']) }}" type="text"
                    autocomplete="username" autofocus placeholder="Enter Username"
                    class="peer w-full px-4 py-2 bg-base-100 text-sm border-1 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
                @error('name')
                    <div class="text-sm text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-base text-base-content font-medium">
                        Password
                    </label>
                    <a href=""
                        class="text-base text-primary font-medium hover:text-primary-focus transition-colors">Forgot
                        Password?</a>
                </div>
                <input id="password" name="password" value="{{ old('password', $data['password']) }}" type="password"
                    autocomplete="current-password" placeholder="Enter Password"
                    class="peer w-full px-4 py-2 bg-base-100 text-sm border-1 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
                @error('password')
                    <div class="text-sm text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex gap-2 items-center">
                <input id="remember" name="remember" type="checkbox" @checked(old('remember', isset($data['remember'])))
                    class="appearance-none relative w-5 h-5 bg-base-100 border-1 border-base-300 rounded cursor-pointer !outline-none !ring-0 transition-all after:transition-all
                hover:bg-base-200
                focus:outline-none
                checked:!bg-primary
                indeterminate:!bg-primary indeterminate:ring-2 indeterminate:ring-primary indeterminate:ring-offset-2
                after:content-[''] after:absolute after:bg-transparent after:border-primary-content
                indeterminate:after:w-0 indeterminate:after:h-full indeterminate:after:bg-transparent indeterminate:after:rotate-90 indeterminate:after:border-r-4 indeterminate:after:border-b-4 indeterminate:after:border-primary-content indeterminate:after:left-[7px] indeterminate:after:bottom-0 indeterminate:after:scale-[0.55]">
                <label for="remember" class="text-base text-base-content font-medium">
                    Remember Me
                </label>
            </div>
            <button type="submit"
                class="w-full py-2 bg-primary text-primary-content hover:bg-primary-focus rounded-md transition-colors">
                Sign In
            </button>
            <div class="text-base">Don't have an account? <a href="{{ $register }}"
                    class="text-primary font-medium hover:text-primary-focus transition-colors">Sign Up</a>
            </div>
        </div>
        <x-common.validation></x-common.validation>
    </form>
</body>

</html>
