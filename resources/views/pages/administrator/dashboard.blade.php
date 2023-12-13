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
            <x-dynamic.panel.main class="@container p-4">

                <div class="flex flex-col gap-4">
                    {{-- @template('modern')
                        <div class="grid grid-cols-3 gap-4">
                            <x-dynamic.resource.stat :resource="$visitors" :name="$visitors->name" :count="$visitors->count"
                                :subcount="$visitors->subcount">
                                <x-slot:icon>
                                    {!! $visitors->icon !!}
                                </x-slot:icon>
                            </x-dynamic.resource.stat>
                        </div>
                    @endtemplate --}}
                    <div class="grid gap-4 @sm:grid-cols-2 @2xl:grid-cols-3 @4xl:grid-cols-4 @6xl:grid-cols-5">
                        <x-dynamic.resource.stat :resource="$service" :name="$service->name" :count="$service->count_all">
                            <x-slot:icon>
                                {!! $service->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>
                        <x-dynamic.resource.stat :resource="$schedule" :name="$schedule->name" :count="$schedule->count_all">
                            <x-slot:icon>
                                {!! $schedule->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>
                        <x-dynamic.resource.stat :resource="$order" :name="$order->name" :count="$order->count_all">
                            <x-slot:icon>
                                {!! $order->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>

                        <x-dynamic.resource.stat :resource="$patient" :name="$patient->name" :count="$patient->count_all">
                            <x-slot:icon>
                                {!! $patient->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>
                        <x-dynamic.resource.stat :resource="$midwife" :name="$midwife->name" :count="$midwife->count_all">
                            <x-slot:icon>
                                {!! $midwife->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>
                        <x-dynamic.resource.stat :resource="$administrator" :name="$administrator->name" :count="$administrator->count_all">
                            <x-slot:icon>
                                {!! $administrator->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>

                        <x-dynamic.resource.stat :resource="$orders_today" :name="$orders_today->name" :count="$orders_today->count_all" >
                            <x-slot:icon>
                                {!! $orders_today->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>
                        {{-- <x-dynamic.resource.stat :resource="$orders_limit" :name="$orders_limit->name" :count="$orders_limit->count_all" :actions="$orders_limit->actions">
                            <x-slot:icon>
                                {!! $orders_limit->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat> --}}
                        <x-dynamic.resource.stat :resource="$location" :name="$location->name" :count="$location->count_all" :actions="$location->actions">
                            <x-slot:icon>
                                {!! $location->icon !!}
                            </x-slot:icon>
                        </x-dynamic.resource.stat>
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
