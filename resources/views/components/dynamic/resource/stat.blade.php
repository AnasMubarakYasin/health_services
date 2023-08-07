@aware(['panel', 'resource'])
@switch($panel->template)
    @case('simple')
        <x-simple.resource.stat {{ $attributes }}>
            <x-slot:icon>
                {{ $icon }}
            </x-slot:icon>
            {{ $slot }}
        </x-simple.resource.form>
    @break

    @case('modern')
        <x-modern.data.stat.regular {{ $attributes }}>
            <x-slot:icon>
                {{ $icon }}
            </x-slot:icon>
            {{ $slot }}
        </x-modern.data.stat.regular>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
