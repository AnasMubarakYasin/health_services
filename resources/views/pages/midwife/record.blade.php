<x-dynamic.panel>
    <x-dynamic.panel.layout>
        <x-slot:head>
            @template('modern')
                @vite('resources/js/components/common/error-boundary.js')
                @vite('resources/js/components/modern/common/theme.js')

                @vite('resources/js/components/modern/dashboard/sidebar.js')
                @vite('resources/js/components/modern/dashboard/topbar.js')
                @vite('resources/js/components/modern/dashboard/customizer.js')

                @vite('resources/js/components/modern/data/form/regular.js')
                @vite('resources/js/components/modern/data/table/regular.js')
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
            <x-dynamic.panel.main class=" flex flex-col gap-4">
                <form id="form"
                    action="{{ route($pregnancy_examination->is_create() ? 'web.midwife.record.create' : 'web.midwife.record.update', ['order' => $order]) }}"
                    method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                    @csrf
                    @if ($pregnancy_examination->is_update())
                        @method('PATCH')
                    @endif
                    <div class="grid gap-4 p-4 bg-base-100 rounded-lg">
                        <div class="font-semibold text-xl text-base-content/70 text-center capitalize">
                            {{ trans('record') }} {{ $order->service->name }}
                        </div>
                        @php
                            $fields = $pregnancy_examination->fields;
                        @endphp
                        <div class="grid sm:grid-cols-2 gap-4">
                            @php
                                $pregnancy_examination->fields = array_slice($fields, 0, 10);
                            @endphp
                            <div class="flex flex-col gap-4">
                                <x-modern.data.form.fields :resource="$pregnancy_examination" :model="$pregnancy_examination->model" />
                            </div>
                            @php
                                $pregnancy_examination->fields = array_slice($fields, 10);
                            @endphp
                            <div class="flex flex-col gap-4">
                                <x-modern.data.form.fields :resource="$pregnancy_examination" :model="$pregnancy_examination->model" />
                            </div>
                        </div>
                    </div>

                    @if ($pregnancy_examination->is_create())
                        <div class="grid gap-4 p-4 bg-base-100 rounded-lg">
                            <div class="grid sm:grid-cols-2 gap-4">
                                <x-modern.data.form.fields :resource="$pregnancy_examination_report" :model="$pregnancy_examination_report->model" />
                            </div>
                        </div>

                        <div class="col-span-2 flex justify-center">
                            <button
                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                                {{ trans($pregnancy_examination->mode) }}
                            </button>
                        </div>
                    @endif
                </form>

                @if ($pregnancy_examination->is_update())
                    <div class="col-span-2 flex justify-center">
                        <button form="form"
                            class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                            data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                            {{ trans($pregnancy_examination->mode) }}
                        </button>
                    </div>

                    <div class="grid gap-4 p-4 bg-base-100 rounded-lg">
                        <x-modern.data.table.sheet :resource="$pregnancy_examination_report">

                        </x-modern.data.table.sheet>
                    </div>

                    <div class="col-span-2 flex justify-center">
                        <a href="{{ $pregnancy_examination_report->web_create() }}"
                            class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                            data-te-ripple-init data-te-ripple-color="ligth">
                            {{ trans('add') }}
                        </a>
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
