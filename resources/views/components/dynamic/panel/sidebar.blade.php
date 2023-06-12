@aware(['panel'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.side-bar {{ $attributes }}></x-simple.panel.side-bar>
    @break

    @case('modern')
        <x-modern.dashboard.sidebar {{ $attributes }}></x-modern.dashboard.sidebar>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
