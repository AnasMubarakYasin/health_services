<x-simple.panel.layout :title="'profile'">
    <x-slot:topbar>
        <x-simple.panel.top-bar>

        </x-simple.panel.top-bar>
    </x-slot:topbar>
    <x-slot:sidebar>
        <x-simple.panel.side-bar>

        </x-simple.panel.side-bar>
    </x-slot:sidebar>
    <x-slot:main>
        <x-simple.panel.profile :resource="$resource"></x-simple.panel.profile>
    </x-slot:main>
    <x-slot:bottombar>
        <x-simple.panel.bottom-bar>

        </x-simple.panel.bottom-bar>
    </x-slot:bottombar>
</x-simple.panel.layout>

