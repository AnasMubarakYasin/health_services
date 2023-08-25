<div class="flex flex-col gap-4 p-4 bg-base-100 text-base-content shadow-all-lg rounded-lg">
    <ul class="">
        <li class="w-full border-b-2 border-base-300 py-4">
            <div class="relative flex gap-2 items-center">
                <label class="inline-block pl-[0.15rem] hover:cursor-pointer capitalize" for="subscribe">
                    <span>{{ trans('subscribe') }}</span>
                </label>
                <input id="subscribe" name="subscribe"type="checkbox" role="switch" data-focus="true"
                    @checked(session('subscribe')) @required(false) @readonly(false)
                    class="appearance-none h-3.5 w-8 rounded-full bg-base-200 border-none
                        before:pointer-events-none before:after:-mt-[3.5px] before:after:ml-[-6px] before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-['']
                        after:absolute after:z-[2] after:-mt-[3.5px] after:ml-[-6px] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-base-300 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-['']
                        checked:bg-primary/70 checked:after:absolute checked:after:z-[2] checked:after:-mt-[3.5px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-['']
                        hover:cursor-pointer
                        focus:outline-none focus:ring-0 focus:before:ml-[-6px] focus:before:scale-100 focus:before:opacity-[0.125] focus:before:shadow-[3px_-1px_0px_13px_hsl(var(--bc))] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary/50 checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_hsl(var(--bc))] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]" />
            </div>
        </li>
        <li class="w-full py-4">
            <div class="relative flex gap-2 items-center">
                <label class="inline-block pl-[0.15rem] hover:cursor-pointer capitalize" for="install">
                    <span>{{ trans('install') }}</span>
                </label>
                <input id="install" name="install"type="checkbox" role="switch" data-focus="true"
                    @checked(session('install')) @required(false) @readonly(false)
                    class="appearance-none h-3.5 w-8 rounded-full bg-base-200 border-none
                        before:pointer-events-none before:after:-mt-[3.5px] before:after:ml-[-6px] before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-['']
                        after:absolute after:z-[2] after:-mt-[3.5px] after:ml-[-6px] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-base-300 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-['']
                        checked:bg-primary/70 checked:after:absolute checked:after:z-[2] checked:after:-mt-[3.5px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-['']
                        hover:cursor-pointer
                        focus:outline-none focus:ring-0 focus:before:ml-[-6px] focus:before:scale-100 focus:before:opacity-[0.125] focus:before:shadow-[3px_-1px_0px_13px_hsl(var(--bc))] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary/50 checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_hsl(var(--bc))] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]" />
            </div>
        </li>
    </ul>
</div>
