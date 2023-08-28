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

                <div class="grid gap-2">
                    <div class="font-bold capitalize">{{ trans('services') }}</div>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($services as $service)
                            <div
                                class="flex flex-col p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <div class="text-lg font-medium capitalize">
                                            {{ $service->name }}
                                        </div>
                                        {{-- <div class="text-xl text-base-content font-medium">
                                {{ $count }}
                            </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="@container grid gap-2">
                    <div class="font-bold capitalize">{{ trans('midwifes') }}</div>
                    <div class="grid @xs:grid-cols-1 @xl:grid-cols-2 @4xl:grid-cols-3 @6xl:grid-cols-4 gap-4">
                        @foreach ($midwifes as $midwife)
                            <div class="flex gap-4 p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                <img src="{{ $midwife->photo_url }}" alt="photo"
                                    class="w-20 h-20 p-1 aspect-square object-cover border border-base-300 rounded">
                                <div class="flex flex-grow flex-col gap-4">
                                    <div>
                                        <div class="text-base font-medium capitalize">
                                            {{ $midwife->fullname }}
                                        </div>
                                        <div class="text-sm font-normal opacity-70 capitalize">
                                            {{ trans('midwife') }}
                                        </div>
                                    </div>
                                    <a href="{{ route('web.patient.order.midwife', ['midwife' => $midwife]) }}"
                                        class="w-fit px-3 py-1 self-end bg-primary text-primary-content text-sm font-medium capitalize rounded hover:bg-primary-focus">
                                        {{ trans('service message') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center gap-2 font-bold capitalize">
                        <div>{{ trans('orders') }}</div>
                        <a href="{{ route('web.patient.order') }}"
                            class="bg-primary text-primary-content p-1 hover:bg-primary-focus rounded-lg">
                            <x-icons.add class="w-5 h-5" stroke="2"></x-icons.add>
                        </a>
                    </div>

                    @if ($order)
                        <div class="@container flex w-full">
                            <div
                                class="flex flex-col gap-2 py-4 @xs:w-full @xl:w-8/12 @4xl:w-6/12 @6xl:w-4/12 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                                <div class="px-6">
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
                                <div class="w-full h-0.5 bg-base-300"></div>
                                <div class="flex flex-col gap-1 px-6">
                                    <div class="font-normal text-base">
                                        <div class="text-base-content/70">{{ trans('midwife') }}</div>
                                        <div>{{ $order->midwife->fullname }}</div>
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
                                    {{-- <div class="font-medium text-base">
                                        {{ trans('midwife') }}: {{ $order->midwife->fullname }}
                                    </div>
                                    <div class="font-medium text-base">
                                        {{ trans('location') }}: {{ $order->location_name }}
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endif
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
