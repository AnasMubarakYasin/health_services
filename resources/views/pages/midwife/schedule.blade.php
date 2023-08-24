@aware([
    'user' => null,
    'panel' => null,
])
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

                @vite('resources/js/components/modern/data/form/regular.js')
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

                <div class="flex flex-col gap-4 p-4 m-auto bg-base-100 w-[320px] rounded-lg">
                    <form id="form" class="flex flex-col gap-x-4 gap-y-8"
                        action="{{ $resource->is_create() ? $resource->api_create() : $resource->api_update($resource->model) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($resource->is_update())
                            @method('PATCH')
                        @endif
                        <div class="font-semibold text-xl text-base-content/70 text-center capitalize">
                            {{ trans('schedule') }}
                        </div>
                        <div class="flex flex-col gap-x-4 gap-y-8">
                            <x-modern.data.form.fields :resource="$resource" :model="$resource->model" />
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <button
                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                                {{ trans($resource->mode) }}
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
