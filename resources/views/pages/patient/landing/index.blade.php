<x-common.patient.landing :panel="$panel" :title="config('dynamic.application.name')">

    <section id="beranda"
        class="grid grid-cols-2 p-5 sm:px-20 bg-[url('https://hellosehat.com/images/homepage-banner/banner-bg.svg')] relative bg-cover bg-no-repeat">
        <div class="flex flex-col justify-center gap-5 sm:h-56">
            <div class="font-bold text-3xl">
                Layanan Homecare Untuk Ibu dan Anak
            </div>
            <div class="text-gray-700 text-base">
                layanan homecare dengan bidan berlisensi untuk memberikan pelayanan kesehatan kepada ibu dan bayi baru
                lahir
            </div>
        </div>
        {{-- <div class="flex justify-center">
            <div class="w-max bg-white rounded-lg p-5 pb-0 shadow-md shadow-stone-600">
                <img class="h-[200px]" src="{{ asset('avatar1.png') }}" alt="">
            </div>
        </div> --}}
    </section>

    <section id="layanan" class="@container px-2 sm:px-24 py-8">
        <div class="font-bold text-lg mb-3">Layanan Kami</div>
        <div
            class="grid grid-cols-2  @xs:grid-rows-3 @xl:grid-cols-3  @xl:grid-rows-2 @2xl:grid-cols-4 @2xl:grid-rows-2 @4xl:grid-cols-5 @4xl:grid-rows-1 gap-4">
            @foreach ($services as $service)
                <a href="{{ route('web.patient.landing.service', ['service' => $service]) }}"
                    class="grid justify-items-center gap-2 p-2 bg-white shadow-lg rounded-xl">
                    <img class="" src="{{ $service->img }}" alt="">
                    <span class="text-center text-lg font-bold capitalize">
                        {{ $service->name }}
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <div id="bidan" class="@container grid gap-2 px-2 sm:px-24 py-8">
        <div class="font-bold text-lg capitalize">Bidan Kami</div>
        <div class="grid @xs:grid-cols-1 @xl:grid-cols-2 @4xl:grid-cols-3 @6xl:grid-cols-4 gap-4">
            @foreach ($midwifes as $midwife)
                <div class="flex gap-4 p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                    <img src="{{ $midwife->photo }}" alt="photo"
                        class="w-24 h-28 p-1 aspect-square object-cover border border-base-300 rounded">
                    <div class="flex flex-grow flex-col gap-4">
                        <div class="flex-grow">
                            <div class="text-base font-medium capitalize">
                                {{ $midwife->fullname }}
                            </div>
                            <div class="text-sm font-normal opacity-70 capitalize">
                                {{ trans('midwife') }}
                            </div>
                            <div class="text-sm font-normal opacity-70 capitalize">
                                {{ $midwife->srt }}
                            </div>
                        </div>
                        <a href="{{ route('web.patient.landing.order', ['midwife' => $midwife]) }}"
                            class="w-fit px-3 py-1 self-end bg-primary text-primary-content text-sm font-medium capitalize rounded hover:bg-primary-focus">
                            {{ trans('service message') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if ($orders)
        <div id="bidan" class="@container grid gap-2 px-2 sm:px-24 py-8">
            <div class="font-bold text-lg capitalize">Pesanan</div>
            <div class="grid gap-4">
                <div class="@container flex gap-4 w-full">
                    @foreach ($orders as $order)
                        {{-- @if ($order->status == 'finished')
                            <button type="button"
                                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                data-te-toggle="modal" data-te-target="#staticBackdrop" data-te-ripple-init
                                data-te-ripple-color="light">
                                Launch static backdrop modal
                            </button>
                        @endif --}}
                        <div
                            class="flex flex-col gap-2 py-4 @xs:w-full @xl:w-8/12 @4xl:w-6/12 @6xl:w-4/12 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                            <div class="px-6">
                                <div class="font-medium text-lg capitalize">{{ $order->service->name }}</div>
                                <div class="flex gap-1">
                                    <div class="font-medium text-sm opacity-70">
                                        {{ date('d/m/Y', strtotime($order->schedule)) }}
                                        {{ date('H:i', strtotime($order->schedule_start)) }}-{{ date('H:i', strtotime($order->schedule_end)) }}
                                    </div>
                                </div>
                            </div>
                            <div class="w-full h-0.5 bg-base-300"></div>
                            <div class="flex flex-col gap-1 px-6">
                                <div class="font-normal text-base">
                                    <div class="text-base-content/70">{{ trans('midwife') }}</div>
                                    <div>{{ $order->midwife->fullname }}</div>
                                </div>
                                <div class="font-normal text-base">
                                    <div class="text-base-content/70">{{ trans('location') }}</div>
                                    @php
                                        $coordinates = json_decode($order->location_coordinates);
                                    @endphp
                                    <a href="{{ route('web.patient.landing.map_navigation', ['coord' => $order->location_coordinates]) }}"
                                        class="text-blue-500 dark:text-blue-600 hover:underline">
                                        {{ $order->location_name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

</x-common.patient.landing>
@foreach ($orders as $order)
    @if ($order->status == 'finished')
        <button id="btn_{{ $order->id }}" type="button" data-click="true"
            class="hidden rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
            data-te-toggle="modal" data-te-target="#staticBackdrop" data-te-ripple-init data-te-ripple-color="light">
            Launch static backdrop modal
        </button>
        <script>
            setTimeout(() => {
                document.getElementById("btn_{{ $order->id }}").click();
            }, 1000);
        </script>
        <div data-te-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            id="staticBackdrop" data-te-backdrop="static" data-te-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div data-te-modal-dialog-ref
                class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
                <div
                    class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                    <div
                        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                        <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                            id="staticBackdropLabel">
                            Konfirmasi
                        </h5>
                        <button type="button"
                            class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                            data-te-modal-dismiss aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div data-te-modal-body-ref class="relative p-4">
                        Konfirmasi pesanan {{ $order->service->name }}, apakah telah selesai?
                    </div>

                    <div
                        class="flex flex-wrap items-center justify-end gap-4 px-4 py-2 rounded-b-md border-t-2 border-base-300">
                        <button
                            class="grid place-items-center px-8 py-2 bg-base-200 text-base-content text-sm font-medium rounded-md transition-colors hover:bg-base-300"
                            data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                            Tidak
                        </button>
                        <form action="{{ route('web.patient.order.confirm.yes', ['order' => $order]) }}"
                            method="POST">
                            @csrf
                            <button
                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-sm font-medium rounded-md transition-colors hover:bg-primary-focus"
                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                                Ya
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
