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

        @default
            <div>unknown {{ $definition->type }}</div>
    @endswitch
@endforeach
