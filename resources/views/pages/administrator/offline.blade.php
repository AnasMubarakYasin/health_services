<x-simple.panel.layout :title="'offline'">
    <x-slot:topbar>
        <x-simple.panel.top-bar>

        </x-simple.panel.top-bar>
    </x-slot:topbar>
    <x-slot:sidebar>
        <x-simple.panel.side-bar>

        </x-simple.panel.side-bar>
    </x-slot:sidebar>
    <x-slot:main>
        <div class="text-center text-gray-600 text-lg dark:text-gray-400">
            {{ trans('you are offline') }}
        </div>
    </x-slot:main>
    <x-slot:bottombar>
        <x-simple.panel.bottom-bar>

        </x-simple.panel.bottom-bar>
    </x-slot:bottombar>
</x-simple.panel.layout>
