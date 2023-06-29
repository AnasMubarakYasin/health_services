@props([
    'title' => 'signin',
    'action' => '',
    'user' => '',
    'data' => null,
    'demo' => false,
    'login' => '',
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

<body
    class="grid content-center justify-items-stretch  sm:place-content-center min-h-screen text-black bg-gray-100 dark:text-white dark:bg-gray-900 shadow">
    <form class="grid m-4 p-4 gap-4 bg-white rounded-lg sm:w-[400px]" action="{{ $action }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <h1 class="text-2xl text-center text-black font-extrabold">
            Sign in to your account
        </h1>
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" id="name" name="name" autofocus
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" autocomplete="username" required value="{{ old('name', $data['name']) }}">
            @error('name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" value="{{ $data['email'] }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" autocomplete="email" required>
            @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" id="password" name="password" value="{{ $data['password'] }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" autocomplete="new-password" required>
            @error('password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        {{-- <div class="flex items-center justify-between">
            <div>
                <input id="aggrement" name="aggrement" type="checkbox" @checked(old('aggrement', isset($data['aggrement'])))
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="aggrement" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I accept the Terms and Conditions</label>
            </div>
        </div> --}}
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Signin
        </button>
        <div class="text-sm">
            Already have an account? <a href="{{ $login }}" class="font-medium text-blue-600 dark:text-blue-500">
                Signin
            </a>
        </div>
        <x-common.validation></x-common.validation>
    </form>
    <div class="mx-4 px-4 font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
        <a href="/">
            landing
        </a>
    </div>
</body>

</html>
