<x-common.patient.landing :panel="$panel" :title="trans('profile')">

    <x-slot:head>
    </x-slot:head>

    <div class="@container flex sm:flex-row flex-col items-center gap-4 my-8 px-2 sm:px-24 py-8 bg-base-100">
        <div class="flex-grow flex gap-4 flex-col order-2 sm:order-1 text-center">
            <h2 class="font-bold text-2xl capitalize">{{ $service->name }}</h2>
            <p>
                {{ $service->description }}
            </p>
            <div></div>
            <div></div>
            <div>
                <a href="{{ route('web.patient.landing.order_common') }}" class="w-fit px-8 py-2 bg-primary hover:bg-primary-focus text-primary-content rounded-full capitalize">
                    {{ trans('service message') }}
                </a>
            </div>
        </div>
        <div class="order-1 sm:order-2 flex-shrink-0">
            <img src="{{ $service->img }}" alt="" class="sm:w-64 sm:h-64 w-52 h-52 aspect-auto">
        </div>
    </div>

</x-common.patient.landing>
