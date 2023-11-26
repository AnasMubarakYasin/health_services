<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />

<x-common.patient.landing :panel="$panel" :title="trans('order')">

    <x-slot:head>
        <script>

        </script>
        @vite('resources/js/pages/patient/map_select.js')
    </x-slot:head>

    <div class="@container w-full grid p-4 gap-4">
        <div class="flex flex-col gap-4 @xs:w-full @2xl:w-10/12 @4xl:w-10/12 @6xl:w-8/12 m-auto p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
            <div id="map" class="h-[80vh] rounded-lg">

            </div>
            <div class="flex gap-4 place-content-center">
                <button id="cancel"
                    class=" px-5 py-1.5 bg-base-200 text-base-content hover:bg-base-300 rounded font-medium capitalize">
                    {{ trans('cancel') }}
                </button>
                <button id="select" disabled
                    class=" px-5 py-1.5 bg-primary text-primary-content hover:bg-primary-focus rounded font-medium capitalize">
                    {{ trans('select') }}
                </button>
            </div>
        </div>
    </div>

</x-common.patient.landing>

<div data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="map-modal" data-te-backdrop="static" data-te-keyboard="false" tabindex="-1" aria-labelledby="map-modalLabel"
    aria-hidden="true">

    <div data-te-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
            <div
                class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                    id="map-modalLabel">
                    Konfirmasi
                </h5>
                <button type="button"
                    class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                    data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div data-te-modal-body-ref class="relative p-4">
                Konfirmasi pesanan apakah telah selesai?
            </div>

            <div
                class="flex flex-wrap items-center justify-end gap-4 px-4 py-2 rounded-b-md border-t-2 border-base-300">
                <button
                    class="grid place-items-center px-8 py-2 bg-base-200 text-base-content text-sm font-medium rounded-md transition-colors hover:bg-base-300"
                    data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                    Tidak
                </button>
                <button
                    class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-sm font-medium rounded-md transition-colors hover:bg-primary-focus"
                    data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                    Ya
                </button>
            </div>
        </div>
    </div>

</div>
