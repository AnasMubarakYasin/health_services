<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />

<x-common.patient.landing :panel="$panel" :title="trans('order')">

    <x-slot:head>
        <script>
            var coord = @json($coord);
        </script>
        @vite('resources/js/pages/patient/map_navigation.js')
    </x-slot:head>

    <div class="@container w-full grid p-4 gap-4">
        <div class="flex flex-col gap-4 @xs:w-full @2xl:w-10/12 @4xl:w-10/12 @6xl:w-8/12 m-auto p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
            <div id="map" class="h-[80vh] rounded-lg">

            </div>
        </div>
    </div>

</x-common.patient.landing>
