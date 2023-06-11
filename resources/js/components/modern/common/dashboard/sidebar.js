import { Sidenav } from "tw-elements";

import Context from "@/lib/context";
import { toggle_button_group } from "@/lib/helper";

var APP_CTX_KEY = "f456grty";

const ctx = Context.get_or_create(APP_CTX_KEY);
const opt = {
    sidenavAccordion: true,
    sidenavBackdrop: true,
    sidenavCloseOnEsc: false,
    sidenavExpandable: true,
    sidenavExpandOnHover: false,
    sidenavHidden: false,
    sidenavWidth: 280,
    sidenavMode: "push",
    sidenavPosition: "fixed",
    sidenavSlim: true,
    sidenavRight: false,
    sidenavSlimWidth: 80,
    sidenavSlimCollapsed: false,
    sidenavContent: "#content",
    // sidenavScrollContainer: "#sidebar nav",
    sidenavTransitionDuration: 300,
};
const data = {
    state: "expanded",
    header_position: "center",
    card_type: "elevated",
    menu_type: "rounded",
};

await ctx.inited();

console.log("sidebar init");

ctx.sync_state("sidebar", data, (value) => Object.assign(data, value));
ctx.action.sidebar = {
    toggle_state,
};

const sidebar_elm = document.getElementById("sidebar");

if (ctx.media_query.sm.matches) {
    opt.sidenavMode = "over";
    opt.sidenavHidden = true;
    opt.sidenavSlim = false;
    opt.sidenavSlimCollapsed = true;
    opt.sidenavBackdropClass =
        "fixed top-0 left-0 z-10 w-full h-full bg-black/30 transition-all duration-300 ease-in-out";
    sidebar_elm.style.zIndex = 11;
} else {
    opt.sidenavMode = "push";
    opt.sidenavHidden = false;
    opt.sidenavSlim = true;
    opt.sidenavSlimCollapsed = false;
}
let sidebar_lib = new Sidenav(sidebar_elm, opt);
if (ctx.media_query.sm.matches) {
    sidebar_lib.hide();
}
sidebar_elm.dataset.expanded = !ctx.media_query.sm.matches;
sidebar_elm.addEventListener("show.te.sidenav", (e) => {
    sidebar_elm.dataset.expanded = true;
    data.state = "expanded";
});
sidebar_elm.addEventListener("hide.te.sidenav", (e) => {
    sidebar_elm.dataset.expanded = false;
    data.state = "collapsed";
});
sidebar_elm.addEventListener("expand.te.sidenav", (e) => {
    sidebar_elm.dataset.expanded = true;
    data.state = "expanded";
});
sidebar_elm.addEventListener("collapse.te.sidenav", (e) => {
    sidebar_elm.dataset.expanded = false;
    data.state = "collapsed";
});

ctx.media_query.sm.addEventListener("change", (event) => {
    if (event.matches) {
        if (data.state == "collapsed") {
            sidebar_lib.toggleSlim();
        }
        sidebar_lib.hide();
        opt.sidenavMode = "over";
        opt.sidenavHidden = true;
        opt.sidenavSlim = false;
        opt.sidenavSlimCollapsed = true;
        opt.sidenavBackdropClass =
            "fixed top-0 left-0 z-10 w-full h-full bg-black/30 transition-all duration-300 ease-in-out";
        sidebar_elm.style.zIndex = 11;
    } else {
        sidebar_lib.show();
        opt.sidenavMode = "push";
        opt.sidenavHidden = false;
        opt.sidenavSlim = true;
        opt.sidenavSlimCollapsed = false;
    }
    document.getElementById("content").style.cssText = "";
    sidebar_elm.dataset.expanded = !event.matches;
    sidebar_lib.dispose();
    sidebar_lib = new Sidenav(sidebar_elm, opt);
});

ctx.event.addEventListener("theme.customizer.init", () => {
    sidebar_elm.dataset.headerPosition = data.header_position;
    const change_sidebar_header_position = toggle_button_group(
        "#sidebar_header_position",
        (value) => {
            data.header_position = value;
            sidebar_elm.dataset.headerPosition = value;
            ctx.update({sidebar: data});
        }
    );
    change_sidebar_header_position(data.header_position);

    sidebar_elm.dataset.cardType = data.card_type;
    const change_sidebar_card_type = toggle_button_group(
        "#sidebar_card_type",
        (value) => {
            data.card_type = value;
            sidebar_elm.dataset.cardType = value;
            ctx.update({sidebar: data});
        }
    );
    change_sidebar_card_type(data.card_type);

    sidebar_elm.dataset.menuType = data.menu_type;
    const change_sidebar_menu_type = toggle_button_group(
        "#sidebar_menu_type",
        (value) => {
            data.menu_type = value;
            sidebar_elm.dataset.menuType = value;
            ctx.update({sidebar: data});
        }
    );
    change_sidebar_menu_type(data.menu_type);
});

function toggle_state() {
    if (ctx.media_query.sm.matches) {
        sidebar_lib.show();
    } else {
        sidebar_lib.toggleSlim();
    }
}
