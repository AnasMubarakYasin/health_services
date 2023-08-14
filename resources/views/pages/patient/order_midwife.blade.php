<x-dynamic.panel>
    <x-dynamic.panel.layout>
        <x-slot:head>
            <script>
                var midwife = @json($midwife);
                var schedules = @json($midwife->schedules);
            </script>
            @template('modern')
                @vite('resources/js/components/common/error-boundary.js')
                @vite('resources/js/components/modern/common/theme.js')

                @vite('resources/js/components/modern/dashboard/sidebar.js')
                @vite('resources/js/components/modern/dashboard/topbar.js')
                @vite('resources/js/components/modern/dashboard/customizer.js')
            @endtemplate

            @vite('resources/js/pages/patient/order_midwife.js')
        </x-slot:head>
        <x-slot:topbar>
            <x-dynamic.panel.topbar>

            </x-dynamic.panel.topbar>
        </x-slot:topbar>
        <x-slot:sidebar>
            <x-dynamic.panel.sidebar>

            </x-dynamic.panel.sidebar>
        </x-slot:sidebar>
        <x-slot:main>
            <x-dynamic.panel.main class="grid gap-4 justify-items-center">
                @error('api')
                    <div class="flex flex-col gap-4 max-w-sm p-4 bg-error font-medium text-error-content rounded-lg shadow-all-lg">
                        {{ $message }}
                    </div>
                @enderror
                <form action="{{ route('web.patient.perform_order_midwife', ['midwife' => $midwife]) }}" method="POST"
                    class="flex flex-col gap-4 max-w-sm  p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
                    @csrf
                    <div class="font-semibold text-lg text-center capitalize">{{ trans('midwife') }} {{ $midwife->fullname }}</div>
                    <ul class="relative m-0 w-full list-none overflow-hidden p-0 transition-[height] duration-200 ease-in-out"
                        data-te-stepper-init data-te-stepper-type="vertical">
                        <li data-te-stepper-step-ref
                            class="relative h-fit after:absolute after:left-[1.9rem] after:top-[2.6rem] after:mt-px after:h-[calc(100%-2.45rem)] after:w-px after:bg-[#e0e0e0] after:content-[''] dark:after:bg-neutral-600">
                            <div data-te-stepper-head-ref
                                class="flex cursor-pointer items-center px-4 py-2 leading-[1.3rem] no-underline after:bg-[#e0e0e0] after:content-[''] hover:bg-[#f9f9f9] focus:outline-none dark:after:bg-neutral-600 dark:hover:bg-[#3b3b3b]">
                                <span data-te-stepper-head-icon-ref
                                    class="mr-3 flex h-[1.938rem] w-[1.938rem] items-center justify-center rounded-full bg-[#ebedef] text-sm font-medium text-[#40464f]">
                                    1
                                </span>
                                <span data-te-stepper-head-text-ref
                                    class="text-neutral-500 after:absolute after:flex after:text-[0.8rem] after:content-[data-content] dark:text-neutral-300">
                                    Pilih Layanan
                                </span>
                            </div>
                            <div data-te-stepper-content-ref
                                class="transition-[height, margin-bottom, padding-top, padding-bottom] left-0 overflow-hidden pt-1 pb-6 pl-[3.75rem] pr-6 duration-300 ease-in-out">
                                <div>
                                    <div>
                                        <select id="service" name="service" data-te-select-init>
                                            <option value="" hidden selected></option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" @selected(old('service') == $service->id)
                                                    class="capitalize">
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label data-te-select-label-ref class="capitalize">{{ trans('service') }}
                                        </label>
                                    </div>
                                    @error('service')
                                        <div class="w-full text-sm text-error" data-te-input-helper-ref>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </li>

                        <li data-te-stepper-step-ref
                            class="relative h-fit after:absolute after:left-[1.9rem] after:top-[2.6rem] after:mt-px after:h-[calc(100%-2.45rem)] after:w-px after:bg-[#e0e0e0] after:content-[''] dark:after:bg-neutral-600">
                            <div data-te-stepper-head-ref
                                class="flex cursor-pointer items-center px-4 py-2 leading-[1.3rem] no-underline after:bg-[#e0e0e0] after:content-[''] hover:bg-[#f9f9f9] focus:outline-none dark:after:bg-neutral-600 dark:hover:bg-[#3b3b3b]">
                                <span data-te-stepper-head-icon-ref
                                    class="mr-3 flex h-[1.938rem] w-[1.938rem] items-center justify-center rounded-full bg-[#ebedef] text-sm font-medium text-[#40464f]">
                                    2
                                </span>
                                <span data-te-stepper-head-text-ref
                                    class="text-neutral-500 after:absolute after:flex after:text-[0.8rem] after:content-[data-content] dark:text-neutral-300">
                                    Pilih Tanggal
                                </span>
                            </div>
                            <div data-te-stepper-content-ref
                                class="transition-[height, margin-bottom, padding-top, padding-bottom] left-0 overflow-hidden pt-1 pb-6 pl-[3.75rem] pr-6 duration-300 ease-in-out">
                                <div>
                                    <div>
                                        <div id="date" class="relative" data-te-input-wrapper-init
                                            data-te-inline="true">
                                            <input id="date" name="date" type="text"
                                                value="{{ old('date') }}" autocomplete="off"
                                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                placeholder="Select a date" data-te-datepicker-toggle-ref />
                                            <label for="date"
                                                class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-base-content/80 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                                                {{ trans('date') }}
                                            </label>
                                        </div>
                                        @error('date')
                                            <div class="w-full text-sm text-error" data-te-input-helper-ref>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li data-te-stepper-step-ref
                            class="relative h-fit after:absolute after:left-[1.9rem] after:top-[2.6rem] after:mt-px after:h-[calc(100%-2.45rem)] after:w-px after:bg-[#e0e0e0] after:content-[''] dark:after:bg-neutral-600">
                            <div data-te-stepper-head-ref
                                class="flex cursor-pointer items-center px-4 py-2 leading-[1.3rem] no-underline after:bg-[#e0e0e0] after:content-[''] hover:bg-[#f9f9f9] focus:outline-none dark:after:bg-neutral-600 dark:hover:bg-[#3b3b3b]">
                                <span data-te-stepper-head-icon-ref
                                    class="mr-3 flex h-[1.938rem] w-[1.938rem] items-center justify-center rounded-full bg-[#ebedef] text-sm font-medium text-[#40464f]">
                                    3
                                </span>
                                <span data-te-stepper-head-text-ref
                                    class="text-neutral-500 after:absolute after:flex after:text-[0.8rem] after:content-[data-content] dark:text-neutral-300">
                                    Pilih Waktu
                                </span>
                            </div>
                            <div data-te-stepper-content-ref
                                class="transition-[height, margin-bottom, padding-top, padding-bottom] left-0 overflow-hidden pt-1 pb-6 pl-[3.75rem] pr-6 duration-300 ease-in-out">
                                <div>
                                    <div>
                                        <div>
                                            <select id="time" name="time">
                                                <option value="" hidden selected></option>
                                            </select>
                                            <label data-te-select-label-ref
                                                class="capitalize">{{ trans('time') }}</label>
                                        </div>
                                        @error('time')
                                            <div class="w-full text-sm text-error" data-te-input-helper-ref>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li data-te-stepper-step-ref
                            class="relative h-fit after:absolute after:left-[1.9rem] after:top-[2.6rem] after:mt-px after:h-[calc(100%-2.45rem)] after:w-px after:bg-[#e0e0e0] after:content-[''] dark:after:bg-neutral-600">
                            <div data-te-stepper-head-ref
                                class="flex cursor-pointer items-center px-4 py-2 leading-[1.3rem] no-underline after:bg-[#e0e0e0] after:content-[''] hover:bg-[#f9f9f9] focus:outline-none dark:after:bg-neutral-600 dark:hover:bg-[#3b3b3b]">
                                <span data-te-stepper-head-icon-ref
                                    class="mr-3 flex h-[1.938rem] w-[1.938rem] items-center justify-center rounded-full bg-[#ebedef] text-sm font-medium text-[#40464f]">
                                    4
                                </span>
                                <span data-te-stepper-head-text-ref
                                    class="text-neutral-500 after:absolute after:flex after:text-[0.8rem] after:content-[data-content] dark:text-neutral-300">
                                    Pilih Lokasi
                                </span>
                            </div>
                            <div data-te-stepper-content-ref
                                class="transition-[height, margin-bottom, padding-top, padding-bottom] left-0 overflow-hidden pt-1 pb-6 pl-[3.75rem] pr-6 duration-300 ease-in-out">
                                <div>
                                    <div>
                                        <div class="relative" data-te-input-wrapper-init>
                                            <input id="location" type="text" name="location"
                                                value="{{ old('location') }}"
                                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                id="location" placeholder="" />
                                            <label for="location"
                                                class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-base-content/80 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                                                {{ trans('location') }}
                                            </label>
                                            <input id="position" type="hidden" name="position"
                                                value="{{ old('position', '[-0,0]') }}">
                                            <label id="toggle_location" role="button" for="position"
                                                class="grid place-items-center swap swap-rotate w-8 h-8 !absolute top-0.5 right-0.5 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg
                                            focus:bg-base-200 focus:text-primary transition-colors"
                                                data-te-ripple-init data-te-ripple-color="primary"
                                                data-te-toggle="tooltip" data-te-placement="bottom"
                                                title="Current Location">
                                                <x-icons.map_pin class="w-5 h-5" stroke="2"></x-icons.map_pin>
                                            </label>
                                        </div>
                                        @error('location')
                                            <div class="w-full text-sm text-error" data-te-input-helper-ref>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('position')
                                            <div class="w-full text-sm text-error" data-te-input-helper-ref>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li data-te-stepper-step-ref class="relative h-fit">
                            <div data-te-stepper-head-ref
                                class="flex cursor-pointer items-center px-4 py-2 leading-[1.3rem] no-underline after:bg-[#e0e0e0] after:content-[''] hover:bg-[#f9f9f9] focus:outline-none dark:after:bg-neutral-600 dark:hover:bg-[#3b3b3b]">
                                <span data-te-stepper-head-icon-ref
                                    class="mr-3 flex h-[1.938rem] w-[1.938rem] items-center justify-center rounded-full bg-[#ebedef] text-sm font-medium text-[#40464f]">
                                    5
                                </span>
                                <span data-te-stepper-head-text-ref
                                    class="text-neutral-500 after:absolute after:flex after:text-[0.8rem] after:content-[data-content] dark:text-neutral-300 capitalize">
                                    {{ trans('complaint') }} ({{ trans('optional') }})
                                </span>
                            </div>
                            <div data-te-stepper-content-ref
                                class="transition-[height, margin-bottom, padding-top, padding-bottom] left-0 overflow-hidden pt-1 pb-6 pl-[3.75rem] pr-6 duration-300 ease-in-out">
                                <div class="relative" data-te-input-wrapper-init>
                                    <textarea
                                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="complaint" rows="3" placeholder="Your message"></textarea>
                                    <label for="complaint"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                                        {{ trans('complaint') }}
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="h-4"></div>
                    <div class="grid place-content-center">
                        <button
                            class=" px-3 py-1 bg-primary text-primary-content hover:bg-primary-focus rounded font-medium capitalize">
                            {{ trans('order') }}
                        </button>
                    </div>
                </form>

            </x-dynamic.panel.main>
        </x-slot:main>
        <x-slot:bottombar>
            <x-dynamic.panel.bottombar>
                footer
            </x-dynamic.panel.bottombar>
        </x-slot:bottombar>
        @template('modern')
            <x-modern.dashboard.customizer>

            </x-modern.dashboard.customizer>
        @endtemplate
    </x-dynamic.panel.layout>
</x-dynamic.panel>
