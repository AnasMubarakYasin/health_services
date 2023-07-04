@aware(['panel', 'resource'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.profile {{ $attributes }}></x-simple.panel.profile>
    @break

    @case('modern')
        <x-modern.dashboard.profile {{ $attributes }}></x-modern.dashboard.profile>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
