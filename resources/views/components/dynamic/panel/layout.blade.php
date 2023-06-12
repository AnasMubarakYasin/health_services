@aware(['panel'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.layout {{ $attributes }}>
            <x-slot:topbar>
                {{ $topbar }}
            </x-slot:topbar>
            <x-slot:sidebar>
                {{ $sidebar }}
            </x-slot:sidebar>
            <x-slot:main>
                {{ $main }}
            </x-slot:main>
            <x-slot:bottombar>
                {{ $bottombar }}
            </x-slot:bottombar>
            {{ $slot }}
        </x-simple.panel.layout>
    @break
    @case('modern')
        <x-modern.layout.dashboard {{ $attributes }}>
            <x-slot:head>
                {{ $head }}
            </x-slot:head>
            <x-slot:topbar>
                {{ $topbar }}
            </x-slot:topbar>
            <x-slot:sidebar>
                {{ $sidebar }}
            </x-slot:sidebar>
            <x-slot:main>
                {{ $main }}
            </x-slot:main>
            <x-slot:bottombar>
                {{ $bottombar }}
            </x-slot:bottombar>
            {{ $slot }}
        </x-modern.layout.dashboard>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
