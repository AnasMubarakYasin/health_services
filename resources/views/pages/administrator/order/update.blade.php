<x-dynamic.panel>
    <x-dynamic.panel.layout>
        @template('simple')
            <x-slot:head>
                <script>
                    var models = [];
                    var resource = @json($resource);
                    var definitions = @json($resource->model::$definitions);
                </script>
                @vite('resources/js/components/simple/resource/form.js')
            </x-slot:head>
        @endtemplate
        @template('modern')
            <x-slot:head>
                @vite('resources/js/components/common/error-boundary.js')
                @vite('resources/js/components/modern/common/theme.js')

                @vite('resources/js/components/modern/dashboard/sidebar.js')
                @vite('resources/js/components/modern/dashboard/topbar.js')
                @vite('resources/js/components/modern/dashboard/customizer.js')

                @vite('resources/js/components/modern/data/form/regular.js')
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
            <x-dynamic.panel.main>
                <x-dynamic.resource.form :resource="$resource">

                </x-dynamic.resource.form>
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
