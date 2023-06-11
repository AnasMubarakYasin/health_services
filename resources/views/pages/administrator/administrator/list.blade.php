<x-simple.panel.layout :title="'list of administrator'">
    <x-slot:topbar>
        <x-simple.panel.top-bar>

        </x-simple.panel.top-bar>
    </x-slot:topbar>
    <x-slot:sidebar>
        <x-simple.panel.side-bar>

        </x-simple.panel.side-bar>
    </x-slot:sidebar>
    <x-slot:main>
        <x-simple.resource.table :resource="$resource">

        </x-simple.resource.table>
    </x-slot:main>
    <x-slot:bottombar>
        <x-simple.panel.bottom-bar>

        </x-simple.panel.bottom-bar>
    </x-slot:bottombar>
</x-simple.panel.layout>

