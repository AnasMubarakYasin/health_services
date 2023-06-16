@template('modern')
    <x-modern.auth.signin {{ $attributes }}>
            {{ $slot }}
    </x-modern.auth.signin>
@endtemplate
@template('simple')
    <x-simple.auth.signin {{ $attributes }}>
            {{ $slot }}
    </x-simple.auth.signin>
@endtemplate
