<x-dynamic.panel>
    <x-dynamic.panel.layout>
        <x-slot:head>
            </script>
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
            <x-dynamic.panel.main class="@container grid gap-4">

                <div
                    class="hidden @xl:grid grid-cols-4 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content rounded-lg shadow-all-lg">
                    <div class="font-bold capitalize">
                        {{ trans('service') }}
                    </div>
                    <div class="font-bold capitalize">
                        {{ trans('patient') }}
                    </div>
                    <div class="font-bold capitalize">
                        {{ trans('description') }}
                    </div>
                    <div class="font-bold capitalize">
                        {{ trans('status') }}
                    </div>
                </div>
                @foreach ($orders as $order)
                    <button href="{{ route('web.patient.order.detail', ['order' => $order]) }}" class="text-left"
                        onclick="location.assign('{{ route('web.midwife.history.detail', ['order' => $order]) }}')">
                        <div
                            class="@xl:hidden grid grid-flow-row gap-2 px-6 py-4 min-w-sm bg-base-100 text-base-content hover:bg-base-200 rounded-lg shadow-all-lg">
                            <div class="flex flex-col">
                                <div class="font-bold capitalize">
                                    {{ trans('service') }}
                                </div>
                                <div>
                                    {{ $order->service->name }}
                                </div>
                            </div>
                            <div class="flex flex-col ga-2">
                                <div class="font-bold capitalize">
                                    {{ trans('patient') }}
                                </div>
                                <div>
                                    {{ $order->patient->fullname }}
                                </div>
                            </div>
                            <div class="flex flex-col ga-2">
                                <div class="font-bold capitalize">
                                    {{ trans('description') }}
                                </div>
                                <div>
                                    <div class="">
                                        {{ date('d/m/Y', strtotime($order->schedule)) }}
                                        {{ date('H:i', strtotime($order->schedule_start)) }}-{{ date('H:i', strtotime($order->schedule_end)) }}
                                    </div>
                                    <div class="">
                                        @php
                                            $coordinates = json_decode($order->location_coordinates);
                                        @endphp
                                        <a href="{{ "https://www.google.com/maps?q=$coordinates[1],$coordinates[0]" }}"
                                            class="text-blue-500 dark:text-blue-600 hover:underline">
                                            {{ $order->location_name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col ga-2">
                                <div class="font-bold capitalize">
                                    {{ trans('status') }}
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
                        </div>
                        <div
                            class="hidden @xl:grid grid-cols-4 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content hover:bg-base-200 rounded-lg shadow-all-lg">
                            <div>
                                {{ $order->service->name }}
                            </div>
                            <div>
                                {{ $order->patient->fullname }}
                            </div>
                            <div class="flex flex-col">
                                <div class="">
                                    {{ date('d/m/Y', strtotime($order->schedule)) }}
                                    {{ date('H:i', strtotime($order->schedule_start)) }}-{{ date('H:i', strtotime($order->schedule_end)) }}
                                </div>
                                <div class="">
                                    @php
                                        $coordinates = json_decode($order->location_coordinates);
                                    @endphp
                                    <a href="{{ "https://www.google.com/maps/@$coordinates[1],$coordinates[0],12z?entry=ttu" }}"
                                        class="text-blue-500 dark:text-blue-600 hover:underline">
                                        {{ $order->location_name }}
                                    </a>
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
                    </button>
                @endforeach

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
