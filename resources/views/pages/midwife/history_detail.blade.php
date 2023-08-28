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

                <div class="@container flex w-full">
                    <div
                        class="flex flex-col gap-2 m-auto py-4 @xs:w-full @xl:w-8/12 @4xl:w-6/12 @6xl:w-4/12 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                        <div class="flex justify-between px-6">
                            <div>
                                <div class="font-medium text-lg capitalize">{{ $order->service->name }}</div>
                                <div class="flex gap-1">
                                    {{-- <div class="font-medium text-sm opacity-70">
                                    {{ $order->location_name }}
                                </div> --}}
                                    <div class="font-medium text-sm opacity-70">
                                        {{ date('d/m/Y', strtotime($order->schedule)) }}
                                        {{ date('H:i', strtotime($order->schedule_start)) }}-{{ date('H:i', strtotime($order->schedule_end)) }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                @switch($order->status)
                                    @case('scheduled')
                                        <div class="w-fit px-2 py-1 bg-base-200 font-medium text-sm capitalize rounded">
                                            {{ trans($order->status) }}
                                        </div>
                                    @break

                                    @case('on_progress')
                                        <div class="w-fit px-2 py-1 bg-info font-medium text-sm rounded">
                                            {{ trans($order->status) }}
                                        </div>
                                    @break

                                    @case('finished')
                                        <div class="w-fit px-2 py-1 bg-success font-medium text-sm capitalize rounded">
                                            {{ trans($order->status) }}
                                        </div>
                                    @break

                                    @default
                                @endswitch
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
                                <a href="{{ "https://www.google.com/maps/@$coordinates[1],$coordinates[0],12z?entry=ttu" }}"
                                    class="text-blue-500 dark:text-blue-600 hover:underline">
                                    {{ $order->location_name }}
                                </a>
                            </div>
                            <div class="font-normal text-base">
                                <div class="text-base-content/70">{{ trans('complaint') }}</div>
                                <div>{{ $order->complaint }}</div>
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
