import { Sidenav, Select } from "tw-elements";

import Context from "@/lib/context";
import { toggle_button_group } from "@/lib/helper";

var APP_CTX_KEY = "f456grty";

const ctx = Context.get(APP_CTX_KEY);
const data = {
    font_family: "sans",
    color_scheme: "light",
};
const opt = {
    // sidenavAccordion: true,
    // sidenavBackdrop: true,
    // sidenavExpandable: true,
    sidenavCloseOnEsc: true,
    sidenavHidden: true,
    sidenavRight: true,
    sidenavWidth: 380,
    sidenavScrollContainer: "#customizer_menu",
    sidenavBackdropClass:
        "fixed top-0 left-0 z-10 w-full h-full bg-black/30 transition-all duration-300 ease-in-out",
};
const select_style = {
    selectLabelWhite: "text-base-300",
    dropdown:
        "relative outline-none min-w-[100px] m-0 scale-[0.8] opacity-0 bg-base-100 shadow-[0_2px_5px_0_rgba(0,0,0,0.16),_0_2px_10px_0_rgba(0,0,0,0.12)] transition duration-200 motion-reduce:transition-none data-[te-select-open]:scale-100 data-[te-select-open]:opacity-100",
    selectOption:
        "flex flex-row items-center justify-between w-full px-4 truncate text-base-content bg-transparent select-none cursor-pointer data-[te-input-multiple-active]:bg-black/5 hover:[&:not([data-te-select-option-disabled])]:bg-black/5 data-[te-input-state-active]:bg-black/5 data-[te-select-option-selected]:data-[te-input-state-active]:bg-black/5 data-[te-select-selected]:data-[te-select-option-disabled]:cursor-default data-[te-select-selected]:data-[te-select-option-disabled]:text-base-300 data-[te-select-selected]:data-[te-select-option-disabled]:bg-transparent data-[te-select-option-selected]:bg-black/[0.02] data-[te-select-option-disabled]:text-base-300 data-[te-select-option-disabled]:cursor-default group-data-[te-select-option-group-ref]/opt:pl-7 dark:hover:[&:not([data-te-select-option-disabled])]:bg-white/30 dark:data-[te-input-state-active]:bg-white/30 dark:data-[te-select-option-selected]:data-[te-input-state-active]:bg-white/30 dark:data-[te-input-multiple-active]:bg-white/30",
};

await ctx.inited();

console.log("customizer init");

ctx.sync_state("customizer", data, (value) => Object.assign(data, value));

const customizer_toggle_elm = document.getElementById("customizer_toggle");
const customizer_elm = document.getElementById("customizer");
const rightbar_lib = new Sidenav(customizer_elm, opt);

customizer_toggle_elm.addEventListener("click", (ev) => {
    rightbar_lib.toggle();
});

const color_scheme_elm = document.getElementById("color_scheme");
const color_scheme_lib = new Select(color_scheme_elm, {}, select_style);
color_scheme_lib.setValue(data.color_scheme);
document.documentElement.dataset.theme = data.color_scheme;
color_scheme_elm.addEventListener("valueChange.te.select", () => {
    data.color_scheme = color_scheme_elm.value;
    document.documentElement.dataset.theme = color_scheme_elm.value;
    ctx.update({ customizer: data });
});

const font_family_elm = document.getElementById("font_family");
const font_family_lib = new Select(font_family_elm, {}, select_style);
font_family_lib.setValue(data.font_family);
document.body.classList.add(`font-${data.font_family}`);
font_family_elm.addEventListener("valueChange.te.select", () => {
    document.body.classList.remove(`font-${data.font_family}`);
    document.body.classList.add(`font-${font_family_elm.value}`);
    data.font_family = font_family_elm.value;
    ctx.update({ customizer: data });
});

ctx.event.dispatchEvent(new CustomEvent("theme.customizer.init", {}));
