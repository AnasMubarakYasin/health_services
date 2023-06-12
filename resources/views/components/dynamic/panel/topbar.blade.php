@aware(['panel'])
@switch($panel->template)
    @case('simple')
        <x-simple.panel.top-bar {{ $attributes }}></x-simple.panel.top-bar>
    @break

    @case('modern')
        <x-modern.dashboard.topbar {{ $attributes }}></x-modern.dashboard.topbar>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
