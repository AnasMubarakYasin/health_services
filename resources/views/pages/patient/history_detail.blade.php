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
                                <div class="text-base-content/70">{{ trans('midwife') }}</div>
                                <div>{{ $order->midwife->fullname }}</div>
                            </div>
                            <div class="font-normal text-base">
                                <div class="text-base-content/70">{{ trans('location') }}</div>
                                @php
                                    $coordinates = json_decode($order->location_coordinates);
                                @endphp
                                <a href="{{ "https://www.google.com/maps?q=$coordinates[1],$coordinates[0]" }}"
                                    class="text-blue-500 dark:text-blue-600 hover:underline">
                                    {{ $order->location_name }}
                                </a>
                            </div>
                            <div class="font-normal text-base">
                                <div class="text-base-content/70">{{ trans('complaint') }}</div>
                                <div>{{ $order->complaint }}</div>
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

                @if ($record)
                    @if (
                        $order->service->name == 'pemeriksaan kehamilan' ||
                            $order->service->name == 'pelayanan KB' ||
                            $order->service->name == 'tindik telinga')
                        <div class="@container grid">
                            <div class="grid gap-4 p-4 bg-base-100 rounded-lg">
                                <div class="font-semibold text-xl text-base-content/70 text-center capitalize">
                                    {{ trans('record') }}
                                </div>
                                @php
                                    $fields = $record->fields;
                                    $length = count($fields);
                                @endphp
                                <div class="grid sm:grid-cols-2 gap-4">
                                    @php
                                        $record->fields = array_slice($fields, 0, ceil($length / 2));
                                    @endphp
                                    <div class="flex flex-col gap-4">
                                        <x-modern.data.form.show :resource="$record" :model="$record->model" />
                                    </div>
                                    @php
                                        $record->fields = array_slice($fields, ceil($length / 2));
                                    @endphp
                                    <div class="flex flex-col gap-4">
                                        <x-modern.data.form.show :resource="$record" :model="$record->model" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="grid gap-4 p-4 bg-base-100 rounded-lg">
                            <div class="font-semibold text-xl text-base-content/70 text-center capitalize">
                                {{ trans('record') }}
                            </div>

                            <ul class="flex flex-row flex-wrap list-none border-b-0" role="tablist" data-te-nav-ref>
                                @foreach ($record as $form)
                                    <li role="presentation">
                                        <h2>
                                            <a href="#tab_{{ $form->model->visit_number }}"
                                                class="block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-base font-medium hover:isolate hover:border-transparent hover:bg-base-200 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary capitalize"
                                                data-te-toggle="pill"
                                                data-te-target="#tab_{{ $form->model->visit_number }}"
                                                {{ !$loop->index ? 'data-te-nav-active' : '' }} role="tab"
                                                aria-controls="{{ $form->model->visit_number }}"
                                                aria-selected="true">{{ $form->model->visit_description }}</a>
                                        </h2>
                                    </li>
                                @endforeach
                            </ul>

                            <div>
                                @foreach ($record as $form)
                                    <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                        id="tab_{{ $form->model->visit_number }}" role="tabpanel"
                                        aria-labelledby="tabs-unread-tab"
                                        {{ !$loop->index ? 'data-te-tab-active' : '' }}>
                                        @php
                                            $fields = $form->fields;
                                            $length = count($fields);
                                        @endphp
                                        <div class="grid sm:grid-cols-2 gap-4">
                                            @php
                                                $form->fields = array_slice($fields, 0, ceil($length / 2));
                                            @endphp
                                            <div class="flex flex-col gap-4">
                                                <x-modern.data.form.show :resource="$form" :model="$form->model" />
                                            </div>
                                            @php
                                                $form->fields = array_slice($fields, ceil($length / 2));
                                            @endphp
                                            <div class="flex flex-col gap-4">
                                                <x-modern.data.form.show :resource="$form" :model="$form->model" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif
                @endif
                @if ($report)
                    <div class="grid gap-4 p-4 bg-base-100 rounded-lg">
                        <x-modern.data.table.sheet :resource="$report">

                        </x-modern.data.table.sheet>
                    </div>
                @endif

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
