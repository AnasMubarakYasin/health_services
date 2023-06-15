@aware(['panel', 'resource'])
@switch($panel->template)
    @case('simple')
        <x-simple.resource.form {{ $attributes }}>

        </x-simple.resource.form>
    @break

    @case('modern')
        <x-modern.data.form.regular {{ $attributes }}></x-modern.data.form.regular>
    @break

    @default
        <div>
            Wrong Template
        </div>
@endswitch
