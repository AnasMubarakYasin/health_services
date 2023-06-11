const APP_CTX_KEY = "br39n487tc";

export class AppCtx {
    sm_media_query?: MediaQueryList = null;
    theme: "light" | "dark" = 'light';
    sidebar_state: "expanded" | "collapsed" = 'expanded';
    sidebar = {
        header_position: "center",
        card_type: "elevated",
        menu_type: "rounded",
    }
    topbar = {
        header_position: "center",
        card_type: "elevated",
        position: "static",
        button_interface: "ghosted",
        button_shape: "circled",
        theme_toggler: "hidden",
    }
    is_sm_screen = false;
    constructor() { }
    listen_sm_screen() {
        this.sm_media_query = matchMedia("(max-width: 640px)")
        this.is_sm_screen = this.sm_media_query.matches;
        this.sm_media_query.addEventListener('change', (event) => {
            this.is_sm_screen = event.matches;
        })
        this.sidebar_state = this.is_sm_screen ? "collapsed" : "expanded";
    }
    load() {
        const raw = localStorage.getItem(APP_CTX_KEY);
        if (!raw) return;
        const data = JSON.parse(raw);
        for (const [key, value] of Object.entries(data)) {
            this[key] = value;
        }
    }
    save() {
        localStorage.setItem(APP_CTX_KEY, JSON.stringify(this));
    }
}