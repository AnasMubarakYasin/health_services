@props([
    'title' => 'signin',
    'description' => 'signin page',
    'action' => '',
    'user' => '',
    'data' => [],
    'demo' => false,
    'login' => '',
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
    @vite('resources/js/components/modern/common/theme.js')
    @vite('resources/js/components/modern/common/password.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $head }}
</head>

<body class="grid place-content-center gap-8 min-h-screen bg-base-200">
    <div class="position fixed top-2 left-2 z-10 flex gap-4 items-center">
        <label role="button"
            class="grid place-items-center w-10 h-10 text-base-content/70 hover:bg-base-300 hover:text-base-content/100 rounded-full swap swap-rotate transition-colors"
            data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Toggle Theme">
            <input id="theme_toggle" type="checkbox" class="hidden" />
            <x-icons.light class="swap-on w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.light>
            <x-icons.dark class="swap-off w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.dark>
        </label>
        @if ($demo)
            <div class="text-base">
                <a href="/"
                    class="text-primary font-semibold hover:text-primary-focus transition-colors">Entry</a>
            </div>
        @endif
    </div>
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
            <div class="text-base-content/70 font-medium">Sign Up to get access App.</div>
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
                <label for="email" class="text-base text-base-content font-medium">
                    Email
                </label>
                <input id="email" name="email" value="{{ old('email', $data['email']) }}" type="email"
                    autocomplete="email" autofocus placeholder="Enter Email Address"
                    class="peer w-full px-4 py-2 bg-base-100 text-sm border-1 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
                @error('email')
                    <div class="text-sm text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-base text-base-content font-medium">
                        Password
                    </label>
                </div>
                <div class="relative">
                    <label role="button" for="password_toggle" data-toggle="password"
                        class="grid place-items-center swap swap-rotate w-8 h-8 !absolute top-1 right-1 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg
                        focus:bg-base-200 focus:text-primary transition-colors"
                        data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip"
                        data-te-placement="bottom" title="Toggle Show">
                        <input id="password_toggle" type="checkbox" class="hidden" />
                        <x-icons.eye_on class="swap-off w-5 h-5" stroke="2"></x-icons.eye_on>
                        <x-icons.eye_off class="swap-on w-5 h-5" stroke="2"></x-icons.eye_off>
                    </label>
                    <input id="password" name="password" value="{{ old('password', $data['password']) }}"
                        type="password" autocomplete="new-password" placeholder="Enter Password"
                        class="peer w-full px-4 py-2 bg-base-100 text-sm border-1 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
                </div>
                @error('password')
                    <div class="text-sm text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex gap-2 items-center">
                    <input id="aggrement" name="aggrement" type="checkbox" @checked(old('aggrement', isset($data['aggrement'])))
                        class="appearance-none relative w-5 h-5 bg-base-100 border-1 border-base-300 rounded cursor-pointer !outline-none !ring-0 transition-all after:transition-all
                    hover:bg-base-200
                    focus:outline-none
                    checked:!bg-primary
                    indeterminate:!bg-primary indeterminate:ring-2 indeterminate:ring-primary indeterminate:ring-offset-2
                    after:content-[''] after:absolute after:bg-transparent after:border-primary-content
                    indeterminate:after:w-0 indeterminate:after:h-full indeterminate:after:bg-transparent indeterminate:after:rotate-90 indeterminate:after:border-r-4 indeterminate:after:border-b-4 indeterminate:after:border-primary-content indeterminate:after:left-[7px] indeterminate:after:bottom-0 indeterminate:after:scale-[0.55]">
                    <label for="aggrement" class="text-base text-base-content font-medium">
                        I agree to privacy policy & terms
                    </label>
                </div>
                @error('aggrement')
                    <div class="text-sm text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit"
                class="w-full py-2 bg-primary text-primary-content hover:bg-primary-focus rounded-md transition-colors">
                Sign Up
            </button>
            <div class="text-base">Already have an account? <a href="{{ $login }}"
                    class="text-primary font-medium hover:text-primary-focus transition-colors">Sign In</a>
            </div>
        </div>
        <x-common.validation></x-common.validation>
    </form>
</body>

</html>
