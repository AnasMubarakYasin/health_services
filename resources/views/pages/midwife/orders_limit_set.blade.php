<x-dynamic.panel>
    <x-dynamic.panel.layout>
        @template('modern')
            <x-slot:head>
                @vite('resources/js/components/common/error-boundary.js')
                @vite('resources/js/components/modern/common/theme.js')

                @vite('resources/js/components/modern/dashboard/sidebar.js')
                @vite('resources/js/components/modern/dashboard/topbar.js')
                @vite('resources/js/components/modern/dashboard/customizer.js')

                @vite('resources/js/components/modern/data/form/regular.js')
            </x-slot:head>
        @endtemplate
        <x-slot:topbar>
            <x-dynamic.panel.topbar>

            </x-dynamic.panel.topbar>
        </x-slot:topbar>
        <x-slot:sidebar>
            <x-dynamic.panel.sidebar>

            </x-dynamic.panel.sidebar>
        </x-slot:sidebar>
        <x-slot:main>
            <x-dynamic.panel.main>

                <div class="flex flex-col gap-4 p-4 m-auto bg-base-100 w-[320px] rounded-lg">
                    <form id="form" class="flex flex-col gap-x-4 gap-y-8"
                        action="{{ route('web.midwife.orders_limit_set_handle') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="font-semibold text-xl text-base-content/70 text-center capitalize">
                            {{ trans('change orders limit') }}
                        </div>
                        <div class="flex flex-col gap-x-4 gap-y-8">
                            {{-- @dd($data) --}}

                            <div class="relative" data-te-input-wrapper-init="" data-field="{{ 'limit' }}">
                                <input id="input_{{ 'limit' }}" name="{{ 'limit' }}"
                                    value="{{ old('limit', $data->limit) }}" type="{{ 'number' }}"
                                    placeholder="{{ trans('limit') }}..." @required(false) @readonly(false)
                                    {{ $errors->has('limit') ? 'aria-invalid="true"' : '' }}
                                    class="peer block min-h-[auto] w-full truncate text-ellipsis rounded-md border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0 focus:ring-0">
                                <label for="input_{{ 'limit' }}"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-base-content/70 transition-all duration-200 ease-out peer-focus:font-semibold peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">
                                    <span>{{ trans('limit') }}</span>
                                    @if (true)
                                        <span class="text-danger font-semibold">*</span>
                                    @endif
                                </label>
                                @error('limit')
                                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold"
                                        data-te-input-helper-ref>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="">
                                <div class="relative flex items-center" data-field="{{ 'date' }}"
                                    data-te-datepicker-init="" data-te-input-wrapper-init="" data-te-inline="true">
                                    <input id="input_{{ 'date' }}" name="{{ 'date' }}" type="text" data-te-datepicker-toggle-ref
                                        value="{{ old('date', $data->date) }}" placeholder="{{ trans('date') }}..."
                                        @required(false) @readonly(false)
                                        {{ $errors->has('date') ? 'aria-invalid="true"' : '' }}
                                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0">
                                    <label for="input_{{ 'date' }}"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-base-content/70 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                                        <span>{{ trans('date') }}</span>
                                        @if (true)
                                            <span class="text-danger font-semibold">*</span>
                                        @endif
                                    </label>
                                    <button id="" type="button"
                                        class="flex items-center justify-content-center [&amp;>svg]:w-5 [&amp;>svg]:h-5 absolute outline-none border-none bg-transparent right-0.5 top-1/2 -translate-x-1/2 -translate-y-1/2 hover:text-primary focus:text-primary dark:hover:text-primary-400 dark:focus:text-primary-400 dark:text-neutral-200"
                                        data-te-datepicker-toggle-button-ref="" data-te-datepicker-toggle-ref="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                    </button>
                                </div>
                                @error('date')
                                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold"
                                        data-te-input-helper-ref>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-span-2 flex justify-center">
                            <button
                                class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-base font-medium rounded-md transition-colors hover:bg-primary-focus capitalize"
                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                                {{ trans('update') }}
                            </button>
                        </div>
                    </form>
                </div>

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
