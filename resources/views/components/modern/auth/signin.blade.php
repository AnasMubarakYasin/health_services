@props([
    'title' => 'signin',
    'description' => 'signin page',
    'action' => '',
    'name' => config('dynamic.application.name'),
    'user' => '',
    'users' => [],
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
    {{-- <meta name="theme-color" content="#3b82f6"> --}}

    @vite('resources/js/components/common/error-boundary.js')
    @vite('resources/js/components/common/bg-gen.js')
    @vite('resources/js/components/modern/common/progress.js')
    @vite('resources/js/components/modern/common/theme.js')
    @vite('resources/js/components/modern/common/password.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $head }}
</head>

<body class="grid place-content-center gap-8 min-h-screen bg-base-200">
    <x-modern.common.progress></x-modern.common.progress>
    <div class="position fixed top-2 left-2 z-10 flex gap-4 items-center">
        <label role="button"
            class="grid place-items-center w-10 h-10 text-base-content/70 hover:bg-base-300 hover:text-base-content/100 rounded-full swap swap-rotate transition-colors"
            data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Toggle Theme">
            <input id="theme_toggle" type="checkbox" class="hidden" />
            <x-icons.light class="swap-on w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.light>
            <x-icons.dark class="swap-off w-5 h-5 sm:w-6 sm:h-6" stroke="2"></x-icons.dark>
        </label>
        @env('local')
        <div class="text-base">
            <a href="/" class="text-primary font-semibold hover:text-primary-focus transition-colors">Entry</a>
        </div>
        @endenv
    </div>
    <div class="grid gap-16 m-16 w-96 z-10">
        <form action="{{ $action }}" method="post"
            class="relative grid gap-8 p-8 w-full bg-base-100 rounded-lg shadow-lg">
            @csrf
            @if ($demo)
                <div class="absolute top-2 left-2 z-10 grid place-content-center">
                    <div class="px-3 py-1 text-sm font-semibold bg-primary text-primary-content rounded-full">Demo</div>
                </div>
            @endif
            <div class="grid text-center pb-6">
                <div class="text-2xl text-primary font-semibold capitalize">
                    {{ $name }}
                </div>
                {{-- <div class="text-base-content/70 font-medium">Sign In to continue App.</div> --}}
            </div>
            <div class="grid gap-4">
                <div class="flex flex-col gap-1">
                    <label for="name" class="text-base text-base-content font-medium">
                        Username
                    </label>
                    <input id="name" name="name" value="{{ old('name', $data['name']) }}" type="text"
                        autocomplete="username" autofocus placeholder="Enter Username"
                        class="peer appearance-none w-full px-4 py-2 bg-base-100 text-sm border-2 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:outline-none focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
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
                            class="text-base text-primary font-medium hover:text-primary-focus transition-colors">
                            {{ trans('modern/auth/signin.to_password') }}
                        </a>
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
                            type="password" autocomplete="current-password" placeholder="Enter Password"
                            class="peer appearance-none w-full px-4 py-2 bg-base-100 text-sm border-2 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:outline-none focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
                    </div>
                    @error('password')
                        <div class="text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex gap-2 items-center">
                    <input id="remember" name="remember" type="checkbox" @checked(old('remember', isset($data['remember'])))
                        class="appearance-none relative w-5 h-5 text-primary bg-base-100 border-2 border-base-300 rounded cursor-pointer outline-none ring-0 ring-transparent shadow-none transition-all after:transition-all
                            hover:bg-base-200 focus-visible:border-primary-focus
                            focus:outline-none focus:ring-0 focus:ring-transparent focus:shadow-none
                            checked:!bg-primary checked:!border-primary checked:after:w-7/12 checked:after:h-full checked:after:rotate-45 checked:after:scale-[0.65] checked:after:left-[3.5px] checked:after:bottom-[1.5px] checked:after:border-r-4 checked:after:border-b-4
                            after:content-[''] after:absolute after:bottom-0 after:bg-transparent after:border-primary-content">
                    <label for="remember" class="text-base text-base-content font-medium">
                        {{ trans('modern/auth/signin.remember') }}
                    </label>
                </div>
                <button type="submit"
                    class="w-full py-2 bg-primary text-primary-content hover:bg-primary-focus rounded-md transition-colors">
                    Sign In
                </button>
                <div class="text-base">{{ trans('modern/auth/signin.to_register') }} <a href="{{ $register }}"
                        class="text-primary font-medium hover:text-primary-focus transition-colors">Sign Up</a>
                </div>
            </div>
            <x-common.validation></x-common.validation>
        </form>

        @if (filled($users))
            <div class="grid gap-2">
                <div class="font-bold text-xl text-center text-primary">
                    {{ trans('modern/auth/signin.as') }}
                </div>
                <div class="border-b-2 border-b-primary"></div>
                <div class="grid gap-2">
                    @foreach ($users as $as => $link)
                        @if ($user != $as)
                            <a href="{{ $link }}"
                                class="grid px-8 py-2 w-full bg-base-100 rounded-lg shadow-lg">
                                <div class="font-medium text-base capitalize">
                                    {{ trans($as) }}
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>

</html>
