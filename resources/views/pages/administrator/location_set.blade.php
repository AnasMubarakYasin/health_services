<x-dynamic.panel>
    <x-dynamic.panel.layout>
        @template('modern')
            <x-slot:head>
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
                <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />

                @vite('resources/js/components/common/error-boundary.js')
                @vite('resources/js/components/modern/common/theme.js')

                @vite('resources/js/components/modern/dashboard/sidebar.js')
                @vite('resources/js/components/modern/dashboard/topbar.js')
                @vite('resources/js/components/modern/dashboard/customizer.js')

                @vite('resources/js/components/modern/data/form/regular.js')

                @vite('resources/js/pages/administrator/map_select.js')

                <script>
                    var address = @json($address);
                    var bounds = @json($bounds);
                    var coordinates = @json($coordinates);
                    var distance = @json($distance);
                </script>
            </x-slot:head>
        @endtemplate
        <x-slot:topbar>
            <x-dynamic.panel.topbar>

            </x-dynamic.panel.topbar>
        </x-slot:topbar>
        <x-slot:sidebar>
            <x-dynamic.panel.sidebar>

            </x-dynamic.panel.sidebar>
        </x-slot:sidebar>
        <x-slot:main>
            <x-dynamic.panel.main class="@container">

                <div
                    class="flex flex-col gap-4 p-4 m-auto bg-base-100 @xs:w-full @2xl:w-10/12 @4xl:w-10/12 @6xl:w-8/12 rounded-lg">
                    <form id="form" class="flex flex-col gap-x-4 gap-y-8"
                        action="{{ route('web.administrator.location_set_handle') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="font-semibold text-xl text-base-content/70 text-center capitalize">
                            {{ trans('change location') }}
                        </div>
                        <div id="map" class="h-[80vh] rounded-lg">

                        </div>
                        <div class="flex flex-col gap-x-4 gap-y-8">
                            <div class="relative" data-te-input-wrapper-init="" data-field="{{ 'distance' }}">
                                <input id="input_{{ 'distance' }}" name="{{ 'distance' }}" data-focus="true"
                                    value="{{ old('distance', $distance) }}" type="{{ 'number' }}" min="1"
                                    placeholder="{{ trans('distance') }}..." @required(false) @readonly(false)
                                    {{ $errors->has('distance') ? 'aria-invalid="true"' : '' }}
                                    class="peer block min-h-[auto] w-full truncate text-ellipsis rounded-md border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0 focus:ring-0">
                                <label for="input_{{ 'distance' }}"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-base-content/70 transition-all duration-200 ease-out peer-focus:font-semibold peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">
                                    <span>{{ trans('distance') }} (km)</span>
                                    @if (true)
                                        <span class="text-danger font-semibold">*</span>
                                    @endif
                                </label>
                                @error('distance')
                                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold"
                                        data-te-input-helper-ref>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" name="bounds">
                            <input type="hidden" name="coordinates">
                            <input type="hidden" name="address">
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <button id="update"
                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                                {{ trans('update') }}
                            </button>
                        </div>
                    </form>
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
