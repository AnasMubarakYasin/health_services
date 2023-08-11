<x-dynamic.panel>
    <x-dynamic.panel.layout>
        <x-slot:head>
            @template('modern')
                @vite('resources/js/components/common/error-boundary.js')

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
                    <div class="font-medium capitalize">{{ trans('services') }}</div>
                    <div class="flex gap-4">
                        @foreach ($services as $service)
                            <a href="{{ route('web.patient.show_order', ['service' => $service]) }}"
                                class="flex flex-col p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg hover:bg-primary/10 hover:text-primary-content">
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <div class="text-lg text-base-content/70 font-medium capitalize">
                                            {{ $service->name }}
                                        </div>
                                        {{-- <div class="text-xl text-base-content font-medium">
                                {{ $count }}
                            </div> --}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="grid gap-2">
                    <div class="font-medium capitalize">{{ trans('order') }}</div>

                    @if ($order)
                        <div>{{ $order }}</div>
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
