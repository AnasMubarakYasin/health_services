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

                <div class="grid gap-4 p-4 bg-base-100 rounded-lg">
                    <div class="font-semibold text-xl text-base-content/70 text-center capitalize">
                        {{ trans('record') }} {{ $order->service->name }}
                    </div>

                    <ul class="flex flex-row flex-wrap list-none border-b-0" role="tablist" data-te-nav-ref>
                        @foreach ($forms as $form)
                            <li role="presentation">
                                <h2>
                                    <a href="#tab_{{ $form->model->visit_number }}"
                                        class="block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-base font-medium hover:isolate hover:border-transparent hover:bg-base-200 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary capitalize"
                                        data-te-toggle="pill" data-te-target="#tab_{{ $form->model->visit_number }}"
                                        {{ !$loop->index ? 'data-te-nav-active' : '' }} role="tab"
                                        aria-controls="{{ $form->model->visit_number }}"
                                        aria-selected="true">{{ $form->model->visit_description }}</a>
                                </h2>
                            </li>
                        @endforeach
                    </ul>

                    <div></div>
                    <div>
                        @foreach ($forms as $form)
                            <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="tab_{{ $form->model->visit_number }}" role="tabpanel" aria-labelledby="tabs-unread-tab" {{ !$loop->index ? 'data-te-tab-active' : '' }} >
                                <form id="form_{{ $form->model->visit_number }}"
                                    action="{{ route($form->is_create() ? 'web.midwife.record.create' : 'web.midwife.record.update', ['order' => $order]) }}"
                                    method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                                    @csrf
                                    @if ($form->is_update())
                                        @method('PATCH')
                                    @endif
                                    <input type="hidden" name="id" value="{{ $form->model->id }}">
                                    <div class="">
                                        @php
                                            $fields = $form->fields;
                                        @endphp
                                        <div class="grid sm:grid-cols-2 gap-4">
                                            @php
                                                $form->fields = array_slice($fields, 0, 7);
                                            @endphp
                                            <div class="flex flex-col gap-4">
                                                <x-modern.data.form.fields :resource="$form" :model="$form->model" />
                                            </div>
                                            @php
                                                $form->fields = array_slice($fields, 7);
                                            @endphp
                                            <div class="flex flex-col gap-4">
                                                <x-modern.data.form.fields :resource="$form" :model="$form->model" />
                                            </div>
                                        </div>
                                    </div>

                                    @if ($form->is_create())
                                        <div class="col-span-2 flex justify-center">
                                            <button
                                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                                                {{ trans($form->mode) }}
                                            </button>
                                        </div>
                                    @else
                                        <div class="col-span-2 flex justify-center">
                                            <button form="form_{{ $form->model->visit_number }}"
                                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                                                {{ trans($form->mode) }}
                                            </button>
                                        </div>
                                    @endif
                                </form>
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
