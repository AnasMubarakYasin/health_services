<aside id="customizer"
    class="fixed right-0 top-0 z-20 h-screen bg-base-100 translate-x-full overflow-hidden shadow-left-xl">
    <header class="flex gap-4 items-center justify-center sticky top-0 h-16 bg-primary text-xl shadow transition-colors">
        <div class="font-semibold text-2xl text-primary-content">
            {{ 'Theme Customizer' }}
        </div>
    </header>
    <section id="customizer_menu" class="flex flex-col gap-4 py-4">
        <div class="flex flex-col gap-2 px-4">
            <div class="text-lg font-medium">Dashboard</div>
            <div class="flex flex-col gap-1">
                <label for="font_family"
                    class="text-sm font-medium text-base-content/70 hover:text-primary/100">Font Family</label>
                <select id="font_family">
                    @foreach (['sans', 'serif', 'mono', 'noto', 'roboto', 'montserrat', 'poppins', 'nunito'] as $font)
                        <option value="{{ $font }}">{{ $font }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-1">
                <label for="color_scheme"
                    class="text-sm font-medium text-base-content/70 hover:text-primary/100">Color Scheme</label>
                <select id="color_scheme">
                    @foreach (['light', 'dark', 'custom', 'cupcake', 'bumblebee', 'emerald', 'corporate', 'synthwave', 'retro', 'cyberpunk', 'valentine', 'halloween', 'garden', 'forest', 'aqua', 'lofi', 'pastel', 'fantasy', 'wireframe', 'black', 'luxury', 'dracula', 'cmyk', 'autumn', 'business', 'acid', 'lemonade', 'night', 'coffee', 'winter'] as $scheme)
                        <option value="{{ $scheme }}">{{ $scheme }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-full h-[1px] bg-base-200">&ThinSpace;</div>
        <div class="px-4">
            <div class="text-lg font-medium">Sidebar</div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content/70">Header Position</div>
                    <div id="sidebar_header_position" class="flex rounded-lg" role="group">
                        <button type="button" value="center"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            center
                        </button>
                        <button type="button" value="left"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            left
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Card Type</div>
                    <div id="sidebar_card_type" class="flex rounded-lg" role="group">
                        <button type="button" value="elevated"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            Elevated
                        </button>
                        <button type="button" value="bordered"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            Bordered
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Menu Type</div>
                    <div id="sidebar_menu_type" class="flex rounded-lg" role="group">
                        <button type="button" value="rounded"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            Rounded
                        </button>
                        <button type="button" value="rectangled"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            Rectangled
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-[1px] bg-base-200">&ThinSpace;</div>
        <div class="px-4">
            <div class="text-lg font-medium">Topbar</div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Position</div>
                    <div id="topbar_position" class="flex rounded-lg" role="group">
                        <button type="button" value="static"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            static
                        </button>
                        <button type="button" value="floated"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            floated
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Card Type</div>
                    <div id="topbar_card_type" class="flex rounded-lg" role="group">
                        <button type="button" value="elevated"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            Elevated
                        </button>
                        <button type="button" value="bordered"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            Bordered
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Button Interface</div>
                    <div id="topbar_button_interface" class="flex rounded-lg" role="group">
                        <button type="button" value="ghosted"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            ghosted
                        </button>
                        <button type="button" value="filled"
                            class="bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            filled
                        </button>
                        <button type="button" value="outlined"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            outlined
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Button Shape</div>
                    <div id="topbar_button_shape" class="flex rounded-lg" role="group">
                        <button type="button" value="rounded"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            rounded
                        </button>
                        <button type="button" value="circled"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            circled
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Theme Toggler</div>
                    <div id="topbar_theme_toggler" class="flex rounded-lg" role="group">
                        <button type="button" value="hidden"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            hidden
                        </button>
                        <button type="button" value="visible"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            visible
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-medium text-base-content text-opacity-70">Title</div>
                    <div id="topbar_title" class="flex rounded-lg" role="group">
                        <button type="button" value="hidden"
                            class="rounded-l bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            hidden
                        </button>
                        <button type="button" value="visible"
                            class="rounded-r bg-base-200 font-medium px-6 pb-2 pt-2.5 text-xs uppercase text-base-content transition duration-150 ease-in-out hover:bg-base-300 focus:text-primary-content focus:bg-primary focus:outline-none focus:ring-0 active:bg-primary"
                            data-te-ripple-init data-te-ripple-color="light">
                            visible
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>
