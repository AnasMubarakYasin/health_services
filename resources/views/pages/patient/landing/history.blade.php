<x-common.patient.landing :panel="$panel" :title="trans('history')">

    <div class="@container grid gap-4 px-2 sm:px-24 py-8">
        <div
        class="hidden @xl:grid grid-cols-4 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content rounded-lg shadow-all-lg">
        <div class="font-bold capitalize">
            {{ trans('service') }}
        </div>
        <div class="font-bold capitalize">
            {{ trans('midwife') }}
        </div>
        <div class="font-bold capitalize">
            {{ trans('description') }}
        </div>
        <div class="font-bold capitalize">
            {{ trans('status') }}
        </div>
    </div>
    @foreach ($orders as $order)
        <button class="text-left"
            onclick="location.assign('{{ route('web.patient.history.detail', ['order' => $order]) }}')">
            <div
                class="@xl:hidden grid grid-flow-row gap-2 px-6 py-4 min-w-sm bg-base-100 text-base-content hover:bg-base-200 rounded-lg shadow-all-lg">
                <div class="flex flex-col">
                    <div class="font-bold capitalize">
                        {{ trans('service') }}
                    </div>
                    <div class="capitalize">
                        {{ $order->service->name }}
                    </div>
                </div>
                <div class="flex flex-col ga-2">
                    <div class="font-bold capitalize">
                        {{ trans('midwife') }}
                    </div>
                    <div>
                        {{ $order->midwife->fullname }}
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
                            <a href="{{ route('web.patient.landing.map_navigation', ['coord' => $order->location_coordinates]) }}"
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
                <div class="capitalize">
                    {{ $order->service->name }}
                </div>
                <div>
                    {{ $order->midwife->fullname }}
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
                        <a href="{{ route('web.patient.landing.map_navigation', ['coord' => $order->location_coordinates]) }}"
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
    </div>

</x-common.patient.landing>
