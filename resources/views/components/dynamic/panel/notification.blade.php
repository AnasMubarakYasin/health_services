@aware(['panel'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.notification {{ $attributes }}></x-simple.panel.notification>
    @break

    @case('modern')
        <x-modern.dashboard.notification {{ $attributes }}></x-modern.dashboard.notification>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
