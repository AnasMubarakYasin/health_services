@aware(['panel'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.bottom-bar {{ $attributes }}></x-simple.panel.bottom-bar>
    @break

    @case('modern')
        <x-modern.dashboard.bottombar {{ $attributes }}></x-modern.dashboard.bottombar>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
