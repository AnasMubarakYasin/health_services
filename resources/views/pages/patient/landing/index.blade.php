<x-common.patient.landing :panel="$panel" :title="config('dynamic.application.name')">

    <section id="beranda"
        class="grid grid-cols-2 p-5 sm:px-20 bg-[url('https://hellosehat.com/images/homepage-banner/banner-bg.svg')] relative bg-cover bg-no-repeat">
        <div class="flex flex-col gap-5">
            <div class="font-bold text-3xl">
                Layanan Homecare Untuk Ibu dan Anak
            </div>
            <div class="text-gray-700 text-base">
                Layanan homecare dengan bidan berlisensi untuk melakukan pemeriksaan kehamilan dan perawatan bayi
                baru lahir
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-max bg-white rounded-lg p-5 pb-0 shadow-md shadow-stone-600">
                <img class="h-[200px]" src="{{ asset('avatar1.png') }}" alt="">
            </div>
        </div>
    </section>

    <section id="layanan" class="@container px-2 sm:px-24 py-8">
        <div class="font-bold text-lg mb-3">Layanan Kami</div>
        <div
            class="grid grid-cols-2  @xs:grid-rows-3 @xl:grid-cols-3  @xl:grid-rows-2 @2xl:grid-cols-4 @2xl:grid-rows-2 @4xl:grid-cols-5 @4xl:grid-rows-1 gap-4">
            @foreach ($services as $service)
                <a href="{{ route('web.patient.landing.service', ['service' => $service]) }}" class="grid justify-items-center gap-2 p-2 bg-white shadow-lg rounded-xl">
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

    @if ($order)
        <div id="bidan" class="@container grid gap-2 px-2 sm:px-24 py-8">
            <div class="font-bold text-lg capitalize">Pesanan</div>
            <div class="grid @xs:grid-cols-1 @xl:grid-cols-2 @4xl:grid-cols-3 @6xl:grid-cols-4 gap-4">
                <div class="@container flex w-full">
                    <div
                        class="flex flex-col gap-2 py-4 @xs:w-full @xl:w-8/12 @4xl:w-6/12 @6xl:w-4/12 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                        <div class="px-6">
                            <div class="font-medium text-lg capitalize">{{ $order->service->name }}</div>
                            <div class="flex gap-1">
                                {{-- <div class="font-medium text-sm opacity-70">
                                {{ $order->location_name }}
                            </div> --}}
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
                                <a href="{{ "https://www.google.com/maps?q=$coordinates[1],$coordinates[0]" }}"
                                    class="text-blue-500 dark:text-blue-600 hover:underline">
                                    {{ $order->location_name }}
                                </a>
                            </div>
                            {{-- <div class="font-medium text-base">
                            {{ trans('midwife') }}: {{ $order->midwife->fullname }}
                        </div>
                        <div class="font-medium text-base">
                            {{ trans('location') }}: {{ $order->location_name }}
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-common.patient.landing>
