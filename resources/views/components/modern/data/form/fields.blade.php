@aware(['resource'])
@foreach ($resource->fields as $field)
    @php
        $definition = $resource->definition($field);
    @endphp
    <input type="hidden" name="_view_any" value="{{ $resource->web_view_any() }}">
    @switch($definition->type)
        @case('string')
            <div class="relative" data-te-input-wrapper-init="" data-field="{{ $field }}">
                <input id="input_{{ $field }}" name="{{ $field }}" data-focus="true"
                    value="{{ old($field, $model->{$field} ?? $definition->default) }}" type="{{ $definition->string_type() }}"
                    placeholder="{{ trans($definition->name) }}..." @required(false) @readonly(false)
                    {{ $errors->has($field) ? 'aria-invalid="true"' : '' }}
                    class="peer block min-h-[auto] w-full truncate text-ellipsis rounded-md border-0 bg-transparent pl-3 pr-10 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0 focus:ring-0">
                <label for="input_{{ $field }}"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-base-content/70 transition-all duration-200 ease-out peer-focus:font-semibold peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">
                    <span>{{ trans($definition->name) }}</span>
                    @if (!$definition->nullable)
                        <span class="text-danger font-semibold">*</span>
                    @endif
                </label>
                <div class="group flex absolute left-0 top-0 w-full max-w-full h-full text-left pointer-events-none"
                    data-te-input-notch-ref="">
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none left-0 top-0 h-full w-2 border-r-0 rounded-l-[0.25rem] group-data-[te-input-focused]:border-r-0
                            group-data-[te-input-state-active]:border-r-0 group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[-1px_0_0_hsl(var(--p)),_0_1px_0_0_hsl(var(--p)),_0_-1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-leading-ref=""></div>
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow-0 shrink-0 basis-auto w-auto max-w-[calc(100%-1rem)] h-full border-r-0 border-l-0
                            group-data-[te-input-focused]:border-x-0 group-data-[te-input-state-active]:border-x-0 group-data-[te-input-focused]:border-t group-data-[te-input-state-active]:border-t group-data-[te-input-focused]:border-solid
                            group-data-[te-input-state-active]:border-solid group-data-[te-input-focused]:border-t-transparent group-data-[te-input-state-active]:border-t-transparent group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[0_1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-middle-ref=""></div>
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow h-full border-l-0 rounded-r-[0.25rem] group-data-[te-input-focused]:border-l-0
                            group-data-[te-input-state-active]:border-l-0 group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[1px_0_0_hsl(var(--p)),_0_-1px_0_0_hsl(var(--p)),_0_1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-trailing-ref=""></div>
                </div>
                @if ($definition->format == 'password')
                    <label role="button" for="toggle_{{ $field }}" data-toggle="password"
                        class="grid place-items-center swap swap-rotate w-8 h-8 !absolute top-1.5 right-1.5 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg
                        focus:bg-base-200 focus:text-primary transition-colors"
                        data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom"
                        title="Toggle Show">
                        <input id="toggle_{{ $field }}" type="checkbox" class="hidden" />
                        <x-icons.eye_on class="swap-off w-5 h-5" stroke="2"></x-icons.eye_on>
                        <x-icons.eye_off class="swap-on w-5 h-5" stroke="2"></x-icons.eye_off>
                    </label>
                @endif
                @error($field)
                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold" data-te-input-helper-ref>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @break

        @case('number')
            <div class="relative" data-te-input-wrapper-init="" data-field="{{ $field }}">
                <input id="input_{{ $field }}" name="{{ $field }}" data-focus="true"
                    value="{{ old($field, $model->{$field} ?? $definition->default) }}"
                    type="{{ $definition->number_type() }}" placeholder="{{ trans($definition->name) }}..." @required(false)
                    @readonly(false) {{ $errors->has($field) ? 'aria-invalid="true"' : '' }}
                    class="peer block min-h-[auto] w-full truncate text-ellipsis rounded-md border-0 bg-transparent pl-3 pr-10 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0 focus:ring-0">
                <label for="input_{{ $field }}"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-base-content/70 transition-all duration-200 ease-out peer-focus:font-semibold peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">
                    <span>{{ trans($definition->name) }}</span>
                    @if (!$definition->nullable)
                        <span class="text-danger font-semibold">*</span>
                    @endif
                </label>
                <div class="group flex absolute left-0 top-0 w-full max-w-full h-full text-left pointer-events-none"
                    data-te-input-notch-ref="">
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none left-0 top-0 h-full w-2 border-r-0 rounded-l-[0.25rem] group-data-[te-input-focused]:border-r-0
                        group-data-[te-input-state-active]:border-r-0 group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[-1px_0_0_hsl(var(--p)),_0_1px_0_0_hsl(var(--p)),_0_-1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-leading-ref=""></div>
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow-0 shrink-0 basis-auto w-auto max-w-[calc(100%-1rem)] h-full border-r-0 border-l-0
                        group-data-[te-input-focused]:border-x-0 group-data-[te-input-state-active]:border-x-0 group-data-[te-input-focused]:border-t group-data-[te-input-state-active]:border-t group-data-[te-input-focused]:border-solid
                        group-data-[te-input-state-active]:border-solid group-data-[te-input-focused]:border-t-transparent group-data-[te-input-state-active]:border-t-transparent group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[0_1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-middle-ref=""></div>
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow h-full border-l-0 rounded-r-[0.25rem] group-data-[te-input-focused]:border-l-0
                        group-data-[te-input-state-active]:border-l-0 group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[1px_0_0_hsl(var(--p)),_0_-1px_0_0_hsl(var(--p)),_0_1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-trailing-ref=""></div>
                </div>
                @error($field)
                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold" data-te-input-helper-ref>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @break

        @case('file')
            <div class="relative" data-te-input-wrapper-init="" data-field="{{ $field }}">
                <input id="preview_input_{{ $field }}" name="preview_{{ $field }}" data-focus="true"
                    value="{{ old("preview_input_$field", $model->{$field} ?? $definition->default) }}" type="text"
                    placeholder="{{ trans($definition->name) }}..." @required(false) @readonly(false)
                    {{ $errors->has($field) ? 'aria-invalid="true"' : '' }}
                    class="peer block min-h-[auto] w-full truncate text-ellipsis rounded-md border-0 bg-transparent pl-3 pr-10 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0 focus:ring-0">
                <label for="preview_input_{{ $field }}"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-base-content/70 transition-all duration-200 ease-out peer-focus:font-semibold peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">
                    <span>{{ trans($definition->name) }}</span>
                    @if (!$definition->nullable)
                        <span class="text-danger font-semibold">*</span>
                    @endif
                </label>
                <div class="group flex absolute left-0 top-0 w-full max-w-full h-full text-left pointer-events-none"
                    data-te-input-notch-ref="">
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none left-0 top-0 h-full w-2 border-r-0 rounded-l-[0.25rem] group-data-[te-input-focused]:border-r-0
                            group-data-[te-input-state-active]:border-r-0 group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[-1px_0_0_hsl(var(--p)),_0_1px_0_0_hsl(var(--p)),_0_-1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-leading-ref=""></div>
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow-0 shrink-0 basis-auto w-auto max-w-[calc(100%-1rem)] h-full border-r-0 border-l-0
                            group-data-[te-input-focused]:border-x-0 group-data-[te-input-state-active]:border-x-0 group-data-[te-input-focused]:border-t group-data-[te-input-state-active]:border-t group-data-[te-input-focused]:border-solid
                            group-data-[te-input-state-active]:border-solid group-data-[te-input-focused]:border-t-transparent group-data-[te-input-state-active]:border-t-transparent group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[0_1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-middle-ref=""></div>
                    <div class="pointer-events-none border-2 border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow h-full border-l-0 rounded-r-[0.25rem] group-data-[te-input-focused]:border-l-0
                            group-data-[te-input-state-active]:border-l-0 group-data-[te-input-focused]:border-primary group-data-[te-input-focused]:shadow-[1px_0_0_hsl(var(--p)),_0_-1px_0_0_hsl(var(--p)),_0_1px_0_0_hsl(var(--p))] {{ $errors->has($field) ? 'border-danger' : 'border-base-300' }}"
                        data-te-input-notch-trailing-ref=""></div>
                </div>
                <label role="button" for="input_{{ $field }}"
                    class="grid place-items-center w-8 h-8 !absolute top-1.5 right-1.5 text-base-content/70 hover:bg-base-200 hover:text-base-content/100 rounded sm:rounded-lg
                                    focus:bg-base-200 focus:text-primary transition-colors"
                    data-te-ripple-init data-te-ripple-color="primary" data-te-toggle="tooltip" data-te-placement="bottom"
                    title="Browse">
                    <x-icons.folder_open class=" w-5 h-5" stroke="2"></x-icons.folder_open>
                </label>
                <input id="input_{{ $field }}" name="{{ $field }}" type="file" class="hidden"
                    accept="{{ $definition->file_type() }}">
                @error($field)
                    <div class="absolute w-full text-sm text-danger/70 peer-focus:text-danger/100" data-te-input-helper-ref>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @break

        @case('enum')
            <div class="relative" data-field="{{ $field }}">
                <select data-te-select-init data-te-select-clear-button="{{ !$definition->default ? 'true' : 'false' }}"
                    {{ $definition->multiple ? 'multiple' : '' }} id="input_{{ $field }}" name="{{ $field }}"
                    data-focus="true" placeholder="{{ trans($definition->name) }}..." @required(false) @readonly(false)
                    {{ $errors->has($field) ? 'aria-invalid="true"' : '' }}>
                    @if (!$definition->default)
                        <option value="" hidden selected></option>
                    @endif
                    @foreach ($definition->enums as $e_key => $e_val)
                        @if (is_array($e_val))
                            <optgroup label="{{ $e_key }}">
                                @foreach ($e_val as $ee_key => $ee_val)
                                    <option @selected(old($field, $model->{$field} ?? $definition->default) == $ee_key) value="{{ $ee_key }}">{{ $ee_val }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @else
                            <option @selected(old($field, $model->{$field} ?? $definition->default) == $e_key) value="{{ $e_key }}">{{ $e_val }}</option>
                        @endif
                    @endforeach
                </select>
                <label data-te-select-label-ref for="input_{{ $field }}">
                    <span>{{ trans($definition->name) }}</span>
                    @if (!$definition->nullable)
                        <span class="text-danger font-semibold">*</span>
                    @endif
                </label>
                @error($field)
                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold" data-te-input-helper-ref>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @break

        @case('time')
            <div class="relative" data-field="{{ $field }}" data-te-format24="true" data-te-timepicker-init=""
                data-te-input-wrapper-init="">
                <input id="input_{{ $field }}" name="{{ $field }}" type="text" data-focus="true"
                    value="{{ old($field, $model->{$field} ?? $definition->default) }}"
                    placeholder="{{ trans($definition->name) }}..." @required(false) @readonly(false)
                    {{ $errors->has($field) ? 'aria-invalid="true"' : '' }}
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                    data-te-timepicker-input="">
                <button id="" tabindex="0" type="button"
                    class="w-5 h-5 ml-auto absolute outline-none border-none bg-transparent right-1 top-1/2 -translate-x-1/2 -translate-y-1/2 transition-all duration-300 ease-[cubic-bezier(0.25,0.1,0.25,1)] cursor-pointer hover:text-primary focus:text-primary"
                    data-te-toggle="timepicker" data-te-timepicker-toggle-button="" data-te-timepicker-icon="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <label for="input_{{ $field }}"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                    <span>{{ trans($definition->name) }}</span>
                    @if (!$definition->nullable)
                        <span class="text-danger font-semibold">*</span>
                    @endif
                </label>
                @error($field)
                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold" data-te-input-helper-ref>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @break

        @case('date')
            <div class="relative" data-field="{{ $field }}" data-te-datepicker-init="" data-te-input-wrapper-init="">
                <input id="input_{{ $field }}" name="{{ $field }}" type="text" data-focus="true"
                    value="{{ old($field, $model->{$field} ?? $definition->default) }}"
                    placeholder="{{ trans($definition->name) }}..." @required(false) @readonly(false)
                    {{ $errors->has($field) ? 'aria-invalid="true"' : '' }}
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0">
                <label for="input_{{ $field }}"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                    <span>{{ trans($definition->name) }}</span>
                    @if (!$definition->nullable)
                        <span class="text-danger font-semibold">*</span>
                    @endif
                </label>
                <button id="" type="button"
                    class="flex items-center justify-content-center [&amp;>svg]:w-5 [&amp;>svg]:h-5 absolute outline-none border-none bg-transparent right-0.5 top-1/2 -translate-x-1/2 -translate-y-1/2 hover:text-primary focus:text-primary dark:hover:text-primary-400 dark:focus:text-primary-400 dark:text-neutral-200"
                    data-te-datepicker-toggle-button-ref="" data-te-datepicker-toggle-ref="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </button>
                @error($field)
                    <div class="absolute w-full text-sm text-danger peer-focus:font-semibold" data-te-input-helper-ref>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- <div class="relative mb-3 xl:w-96" data-te-datepicker-init="" data-te-input-wrapper-init="">
                <input type="text"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&amp;:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                    placeholder="Select a date">
                <label for="floatingInput"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                    style="margin-left: 0px;">Select a date</label>
                <button id="datepicker-toggle-796505" type="button"
                    class="flex items-center justify-content-center [&amp;>svg]:w-5 [&amp;>svg]:h-5 absolute outline-none border-none bg-transparent right-0.5 top-1/2 -translate-x-1/2 -translate-y-1/2 hover:text-primary focus:text-primary dark:hover:text-primary-400 dark:focus:text-primary-400 dark:text-neutral-200"
                    data-te-datepicker-toggle-button-ref="" data-te-datepicker-toggle-ref="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </button>
            </div> --}}
        @break

        @case('model')
            @if ($model->definition($field)->array)
                <script>
                    models.push("{{ $model->definition($field)->alias }}");
                </script>
                {{-- <div> {{ trans($model->definition($field)->name) }} models </div> --}}
                <div class="flex flex-col gap-2 {{ $resource->hidden($field) }}">
                    <label for="{{ $model->definition($field)->alias }}"
                        class="capitalize text-sm font-medium text-gray-900 dark:text-white">
                        {{ trans($model->definition($field)->name) }}
                    </label>
                    <div class="flex items-center gap-2">
                        <div class="relative w-full">
                            <input type="text" list="{{ $model->definition($field)->alias }}_dlist" multiple
                                autocomplete="off" id="{{ $model->definition($field)->alias }}_box"
                                name="{{ $model->definition($field)->alias }}_box"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="{{ trans($model->definition($field)->name) }}">
                            <datalist id="{{ $model->definition($field)->alias }}_dlist">
                                @foreach ($resource->fetch_relation($model->definition($field)) as $relation)
                                    <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <button type="button" id="{{ $model->definition($field)->alias }}_add"
                            class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                                </path>
                            </svg>
                            <span class="sr-only">add</span>
                        </button>
                    </div>
                    @error($model->definition($field)->alias)
                        <p class="text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="divide-y divide-gray-100 dark:divide-gray-600 w-full"></div>
                    <ul id="{{ $model->definition($field)->alias }}_list" class="flex flex-col gap-2">
                        @foreach (old("{$model->definition($field)->alias}") ?? $model->{$field} as $value)
                            @php
                                if (is_object($value)) {
                                    $value = $value->id;
                                }
                            @endphp
                            <li class="flex items-center gap-2">
                                <div class="relative w-full">
                                    <input type="text"
                                        id="{{ $model->definition($field)->alias }}_{{ $loop->iteration }}"
                                        name="{{ $model->definition($field)->alias }}[]" value="{{ $value }}"
                                        class="block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required>
                                </div>
                                <button type="button"
                                    id="{{ $model->definition($field)->alias }}_{{ $loop->iteration }}_del"
                                    class="p-2.5 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4">
                                        </path>
                                    </svg>
                                    <span class="sr-only">delete</span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="relative" data-field="{{ $definition->alias }}">
                    <select data-te-select-init data-te-select-clear-button="{{ !$definition->default ? 'true' : 'false' }}"
                        {{ $definition->multiple ? 'multiple' : '' }} id="input_{{ $definition->alias }}"
                        name="{{ $definition->alias }}" data-focus="true" placeholder="{{ trans($definition->name) }}..."
                        @required(false) @readonly(false)
                        {{ $errors->has($definition->alias) ? 'aria-invalid="true"' : '' }}>
                        @if (!$definition->default)
                            <option value="" hidden selected></option>
                        @endif
                        @foreach ($resource->fetch_relation($definition) as $relation)
                            <option @selected(old($definition->alias, $model->{$definition->alias} ?? $definition->default) == $relation->id) value="{{ $relation->id }}">{{ $relation->name }}</option>
                        @endforeach
                    </select>
                    <label data-te-select-label-ref for="input_{{ $definition->alias }}">
                        <span>{{ trans($definition->name) }}</span>
                        @if (!$definition->nullable)
                            <span class="text-danger font-semibold">*</span>
                        @endif
                    </label>
                    @error($definition->alias)
                        <div class="absolute w-full text-sm text-danger peer-focus:font-semibold" data-te-input-helper-ref>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif
        @break

        @default
            <div>unknown {{ $definition->type }}</div>
    @endswitch
@endforeach
