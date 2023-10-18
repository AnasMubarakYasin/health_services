@props(['cwd', 'async', 'input', 'output'])
<form action="{{ route('web.administrator.command') }}" method="POST" enctype="multipart/form-data"
    class="@container grid gap-4 p-4 bg-base-100 text-base-content rounded-lg shadow-all-lg">
    @csrf
    <div class="flex flex-col gap-2">
        <label for="input" class="text-base text-base-content font-medium">
            input
        </label>
        <input id="input" name="input" value="{{ old('input', $input) }}" type="text" autofocus
            placeholder="Enter Command"
            class="peer appearance-none w-full px-4 py-2 bg-base-100 text-sm border-2 border-base-300 outline-none hover:bg-base-200 focus:bg-base-100 focus:border-primary focus:outline-none focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors" />
        @error('input')
            <div class="text-sm text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="flex gap-2 items-center">
        <input id="async" name="async" type="checkbox" @checked(old('async', isset($async)))
            class="appearance-none relative w-5 h-5 text-primary bg-base-100 border-2 border-base-300 rounded cursor-pointer outline-none ring-0 ring-transparent shadow-none transition-all after:transition-all
                hover:bg-base-200 focus-visible:border-primary-focus
                focus:outline-none focus:ring-0 focus:ring-transparent focus:shadow-none
                checked:!bg-primary checked:!border-primary checked:after:w-7/12 checked:after:h-full checked:after:rotate-45 checked:after:scale-[0.65] checked:after:left-[3.5px] checked:after:bottom-[1.5px] checked:after:border-r-4 checked:after:border-b-4
                after:content-[''] after:absolute after:bottom-0 after:bg-transparent after:border-primary-content">
        <label for="async" class="text-base text-base-content font-medium">
            async
        </label>
    </div>
    <div class="flex flex-col gap-2">
        <label for="output" class="text-base text-base-content font-medium">
            output
        </label>
        <output id="output" name="output" placeholder="Enter Command"
            class="peer appearance-none w-full px-4 py-2 bg-base-100 text-sm border-2 border-base-300 outline-none focus:bg-base-100 focus:border-primary focus:outline-none focus:ring-0 focus-visible:border-primary text-base-content rounded-md transition-colors"
            style="white-space: pre-line">
            {{ old('output', $output) }}
        </output>
        @error('output')
            <div class="text-sm text-danger">{{ $message }}</div>
        @enderror
    </div>
</form>
