import {} from "tw-elements";

import Context from "@/lib/context";
import { toggle_button_group } from "@/lib/helper";

var APP_CTX_KEY = "f456grty";

const ctx = Context.get(APP_CTX_KEY);
const data = {
    header_position: "center",
    card_type: "elevated",
    position: "static",
    button_interface: "ghosted",
    button_shape: "circled",
    theme_toggler: "hidden",
    title: "hidden",
};

await ctx.inited();

console.log("topbar init");

ctx.sync_state("topbar", data, (value) => Object.assign(data, value));

const topbar_elm = document.getElementById("topbar");
const sidebar_toggle_elm = document.getElementById("sidebar_toggle");
const icon_slim = sidebar_toggle_elm.parentElement.querySelector(".swap-on");
const icon_regular =
    sidebar_toggle_elm.parentElement.querySelector(".swap-off");
const icon_slim_className = icon_slim.classList.value;
const icon_regular_className = icon_regular.classList.value;

if (ctx.media_query.sm.matches) {
    icon_slim.classList.value = icon_regular_className;
    icon_regular.classList.value = icon_slim_className;
}

ctx.media_query.sm.addEventListener("change", (event) => {
    // if (event.matches) {
    //     const icon_regular_className = icon_regular.classList.value;
    //     icon_regular.classList.value = icon_slim.classList.value;
    //     icon_slim.classList.value = icon_regular_className;
    // } else {
    //     const icon_slim_className = icon_slim.classList.value;
    //     icon_slim.classList.value = icon_regular.classList.value;
    //     icon_regular.classList.value = icon_slim_className;
    // }
    // console.log(icon_slim.classList.value);
    // if (icon_slim.classList.value == icon_regular_className) {
    //     icon_slim.classList.value = icon_slim_className;
    //     icon_regular.classList.value = icon_regular_className;
    // } else {
    //     icon_slim.classList.value = icon_regular_className;
    //     icon_regular.classList.value = icon_slim_className;
    // }
});
sidebar_toggle_elm.addEventListener("click", () => {
    console.log(ctx);
    ctx.action.sidebar.toggle_state();
});

ctx.event.addEventListener("theme.customizer.init", () => {
    const customs = [
        "position",
        "card_type",
        "button_interface",
        "button_shape",
        "theme_toggler",
        'title',
    ];
    const snake_to_camel = (str) =>
        str
            .toLowerCase()
            .replace(/([-_][a-z])/g, (group) =>
                group.toUpperCase().replace("-", "").replace("_", "")
            );
    for (const custom of customs) {
        topbar_elm.dataset[snake_to_camel(custom)] = data[custom];
        const on_change = toggle_button_group(`#topbar_${custom}`, (value) => {
            data[custom] = value;
            topbar_elm.dataset[snake_to_camel(custom)] = value;
            ctx.update({ topbar: data });
        });
        on_change(data[custom]);
    }
});
