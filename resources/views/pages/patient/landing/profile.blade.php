<x-common.patient.landing :panel="$panel" :title="trans('profile')">

    <x-slot:head>
        @vite('resources/js/components/modern/data/form/regular.js')
    </x-slot:head>

    <div class="@container grid gap-4 px-2 sm:px-24 py-8">
        <x-dynamic.panel.profile :resource="$resource">

        </x-dynamic.panel.profile>
    </div>

</x-common.patient.landing>
