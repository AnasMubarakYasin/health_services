<x-dynamic.panel>
    <x-dynamic.panel.layout>
        <x-slot:head>
            @template('modern')
                @vite('resources/js/components/common/error-boundary.js')

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

                <div class="@container grid gap-2">
                    <div class="flex items-center gap-2 font-bold capitalize">
                        {{ trans('schedules') }}
                        <a href="{{ route('web.midwife.schedule_create') }}"
                            class="bg-primary text-primary-content p-1 hover:bg-primary-focus rounded-lg">
                            <x-icons.add class="w-5 h-5" stroke="2"></x-icons.add>
                        </a>
                    </div>
                    <div class="flex gap-4">
                        @foreach ($schedules_coll as $schedule)
                            <div class="flex flex-col gap-2 p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                <div class="flex justify-between items-center text-lg font-medium capitalize">
                                    <div>{{ trans($schedule['day']) }}</div>
                                </div>
                                @foreach ($schedule['times'] as $key => $time)
                                    <div @class([
                                        'flex justify-between items-center gap-4 text-base text-base-content/70 font-medium leading-[normal] capitalize',
                                        'text-red-500' => !$schedule['active'][$key],
                                    ])>
                                        <div>{{ $time }}</div>
                                        <a href="{{ route('web.midwife.schedule_update', ['schedule' => $schedule['ids'][$key]]) }}"
                                            class="text-blue-500">
                                            <x-icons.edit></x-icons.edit>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid gap-2">
                    <div class="font-bold capitalize">{{ trans('orders') }}</div>
                    <div class="flex gap-4">
                        @foreach ($orders as $order)
                            <div class="@container flex w-full">
                                <div
                                    class="flex flex-col gap-2 py-4 @xs:w-full @xl:w-8/12 @4xl:w-6/12 @6xl:w-4/12 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                    <div class="px-6">
                                        <div class="font-medium text-lg capitalize">{{ $order->service->name }}</div>
                                        <div class="flex gap-1">
                                            <div class="font-medium text-sm opacity-70">
                                                {{ date('d/m/Y', strtotime($order->schedule)) }}
                                                {{ date('H:i', strtotime($order->schedule_start)) }}-{{ date('H:i', strtotime($order->schedule_end)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full h-0.5 bg-base-300"></div>
                                    <div class="flex flex-col gap-1 px-6">
                                        <div class="font-normal text-base">
                                            <div class="text-base-content/70">{{ trans('patient') }}</div>
                                            <div>{{ $order->patient->fullname }}</div>
                                        </div>
                                        <div class="font-normal text-base">
                                            <div class="text-base-content/70">{{ trans('location') }}</div>
                                            @php
                                                $coordinates = json_decode($order->location_coordinates);
                                            @endphp
                                            <a href="https://www.google.com/maps/@ {{ $coordinates[1] }},{{ $coordinates[0] }},15z?entry=ttu"
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
