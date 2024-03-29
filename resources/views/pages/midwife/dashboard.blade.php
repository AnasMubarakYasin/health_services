<x-dynamic.panel>
    <x-dynamic.panel.layout>
        <x-slot:head>
            @template('modern')
                @vite('resources/js/components/common/error-boundary.js')
                @vite('resources/js/components/modern/common/theme.js')

                @vite('resources/js/components/modern/dashboard/sidebar.js')
                @vite('resources/js/components/modern/dashboard/topbar.js')
                @vite('resources/js/components/modern/dashboard/customizer.js')
            @endtemplate
        </x-slot:head>
        <x-slot:topbar>
            <x-dynamic.panel.topbar>

            </x-dynamic.panel.topbar>
        </x-slot:topbar>
        <x-slot:sidebar>
            <x-dynamic.panel.sidebar>

            </x-dynamic.panel.sidebar>
        </x-slot:sidebar>
        <x-slot:main>
            <x-dynamic.panel.main class="grid gap-4">

                <div class="@container grid gap-2 z-[1]">
                    <div class="flex items-center gap-2 font-bold capitalize">
                        <div>{{ trans('schedules') }}</div>
                        <a href="{{ route('web.midwife.schedule.create') }}"
                            class="bg-primary text-primary-content p-1 hover:bg-primary-focus rounded-lg">
                            <x-icons.add class="w-5 h-5" stroke="2"></x-icons.add>
                        </a>
                    </div>
                    <div class="grid gap-4 @sm:grid-cols-2 @2xl:grid-cols-3 @4xl:grid-cols-4 @6xl:grid-cols-5">
                        @foreach ($schedules_coll as $schedule)
                            <div class="flex flex-col gap-2 p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                <div class="flex justify-between items-center text-lg font-medium capitalize">
                                    <div>{{ trans($schedule['day']) }}</div>
                                </div>
                                @foreach ($schedule['times'] as $key => $time)
                                    <div
                                        class="flex justify-between items-center gap-4 text-base text-base-content/70 font-medium leading-[normal] capitalize">
                                        <div @class([
                                            'whitespace-nowrap',
                                            'text-red-500' => !$schedule['active'][$key],
                                        ])>{{ $time }}</div>
                                        <div class="relative" data-te-dropdown-position="dropend">
                                            <button
                                                href="{{ route('web.midwife.schedule.update', ['schedule' => $schedule['ids'][$key]]) }}"
                                                class="" data-te-dropdown-toggle-ref>
                                                <x-icons.ellipsis_vertical></x-icons.ellipsis_vertical>
                                            </button>
                                            <ul class="absolute z-10 m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-base-100 bg-clip-padding text-left text-base shadow-all-lg [&[data-te-dropdown-show]]:block"
                                                data-te-dropdown-menu-ref>
                                                <li>
                                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-base-content hover:bg-base-200 active:text-base-content active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-base-400 capitalize"
                                                        href="{{ route('web.midwife.schedule.update', ['schedule' => $schedule['ids'][$key]]) }}"
                                                        data-te-dropdown-item-ref>{{ trans('update') }}</a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('web.midwife.schedule.update', ['schedule' => $schedule['ids'][$key]]) }}"
                                                        method="post" class="contents">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-left text-sm font-normal text-base-content hover:bg-base-200 active:text-base-content active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-base-400 capitalize"
                                                            data-te-dropdown-item-ref>
                                                            {{ trans_choice('delete', 1) }}
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="@container grid gap-2">
                    <div class="font-bold capitalize">{{ trans('orders') }}</div>
                    <div class="grid @xl:grid-cols-2 @2xl:grid-cols-3 gap-4">
                        @foreach ($orders as $order)
                            <div class="flex w-full">
                                <div
                                    class="flex flex-col gap-2 w-full py-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                    <div class="flex justify-between items-start px-6">
                                        <div>
                                            <div class="font-medium text-lg capitalize">{{ $order->service->name }}
                                            </div>
                                            <div class="flex gap-1">
                                                <div class="font-medium text-sm opacity-70">
                                                    {{ date('d/m/Y', strtotime($order->schedule)) }}
                                                    {{ date('H:i', strtotime($order->schedule_start)) }}-{{ date('H:i', strtotime($order->schedule_end)) }}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <a href="{{ route('web.midwife.schedule.create') }}"
                                            class="inline-block bg-primary text-primary-content p-1 hover:bg-primary-focus rounded-lg">
                                            <x-icons.ellipsis_vertical class="w-5 h-5" stroke="2"></x-icons.ellipsis_vertical>
                                        </a> --}}
                                        <div class="relative" data-te-dropdown-position="dropend">
                                            <button class="" data-te-dropdown-toggle-ref>
                                                <x-icons.ellipsis_vertical></x-icons.ellipsis_vertical>
                                            </button>
                                            <ul class="absolute z-10 m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-base-100 bg-clip-padding text-base shadow-all-lg [&[data-te-dropdown-show]]:block"
                                                data-te-dropdown-menu-ref>
                                                <li>
                                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm text-left font-normal text-base-content hover:bg-base-200 active:text-base-content active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-base-400 capitalize"
                                                        href="{{ route('web.midwife.record.edit', ['order' => $order]) }}"
                                                        data-te-dropdown-item-ref>{{ trans('record') }}</a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('web.midwife.order.done', ['order' => $order]) }}"
                                                        method="post" class="contents">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button
                                                            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm text-left font-normal text-base-content hover:bg-base-200 active:text-base-content active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-base-400 capitalize"
                                                            data-te-dropdown-item-ref>
                                                            {{ trans('finish') }}
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="w-full h-0.5 bg-base-300"></div>
                                    <div class="flex flex-col gap-1 px-6">
                                        <div class="font-normal text-base">
                                            <div class="text-base-content/70 capitalize">{{ trans('patient') }}</div>
                                            <div>{{ $order->patient->fullname }}</div>
                                        </div>
                                        <div class="font-normal text-base">
                                            <div class="text-base-content/70 capitalize">{{ trans('telp') }}</div>
                                            <a href=" https://wa.me/{{ $order->patient->telp }}"
                                                class="text-blue-500 dark:text-blue-600 hover:underline">{{ $order->patient->telp }}</a>
                                        </div>
                                        <div class="font-normal text-base">
                                            <div class="text-base-content/70 capitalize">{{ trans('location') }}</div>
                                            @php
                                                $coordinates = json_decode($order->location_coordinates);
                                            @endphp
                                            <a href="{{ route('web.midwife.map_navigation', ['coord' => $order->location_coordinates]) }}"
                                                class="text-blue-500 dark:text-blue-600 hover:underline">
                                                {{ $order->location_name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="@container grid gap-2 z-[1]">
                    <div class="flex items-center gap-2 font-bold capitalize">
                        <div>{{ trans('etc') }}</div>
                    </div>
                    <div class="grid @xl:grid-cols-2 @2xl:grid-cols-3 gap-4">
                        <div class="flex w-full">
                            <div
                                class="flex flex-col gap-2 w-full py-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                <div class="flex justify-between items-start px-6">
                                    <div>
                                        <div class="font-medium text-lg capitalize">
                                            {{ trans('orders limit') }}
                                        </div>
                                    </div>
                                    <div class="relative" data-te-dropdown-position="dropend">
                                        <button class="" data-te-dropdown-toggle-ref>
                                            <x-icons.ellipsis_vertical></x-icons.ellipsis_vertical>
                                        </button>
                                        <ul class="absolute z-10 m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-base-100 bg-clip-padding text-base shadow-all-lg [&[data-te-dropdown-show]]:block"
                                            data-te-dropdown-menu-ref>
                                            <li>
                                                <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm text-left font-normal text-base-content hover:bg-base-200 active:text-base-content active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-base-400 capitalize"
                                                    href="{{ route('web.midwife.orders_limit_set') }}"
                                                    data-te-dropdown-item-ref>{{ $orders_limit ? trans('change') : trans('create') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="w-full h-0.5 bg-base-300"></div>
                                <div class="flex flex-col gap-1 px-6">
                                    @if ($orders_limit)
                                        <div class="font-normal text-base capitalize">
                                            <div class="text-base-content/70">{{ trans('limit') }}</div>
                                            <div>{{ $orders_limit->limit }}</div>
                                        </div>
                                        <div class="font-normal text-base capitalize">
                                            <div class="text-base-content/70">{{ trans('date') }}</div>
                                            <div>{{ date('d/m/Y', strtotime($orders_limit->date)) }}</div>
                                        </div>
                                    @else
                                    <div class="font-normal text-lg text-base-content/50 pt-2 text-center">
                                        {{ trans("empty") }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </x-dynamic.panel.main>
        </x-slot:main>
        <x-slot:bottombar>
            <x-dynamic.panel.bottombar>
                footer
            </x-dynamic.panel.bottombar>
        </x-slot:bottombar>
        @template('modern')
            <x-modern.dashboard.customizer>

            </x-modern.dashboard.customizer>
        @endtemplate
    </x-dynamic.panel.layout>
</x-dynamic.panel>
