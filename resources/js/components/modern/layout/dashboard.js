import Context from "@/lib/context";

import {
    Animate,
    Ripple,
    Sidenav,
    Collapse,
    Dropdown,
    Tooltip,
    Button,
    Select,
    initTE,
} from "tw-elements";

initTE({
    // Animate,
    Ripple,

    // Sidenav,
    Collapse,
    Dropdown,
    // Tooltip,

    // Button,
    Select,
});

var APP_CTX_KEY = "f456grty";

const ctx = Context.create(APP_CTX_KEY);

ctx.init();

console.log("dashboard init");
console.log(panel);

const dropdownElementList = [].slice.call(
    document.querySelectorAll("[data-te-dropdown-toggle-ref]")
);
dropdownElementList.map((el) =>
    Dropdown.getOrCreateInstance(el, {
        autoClose: "outside",
        offset: [0, 16],
        popperConfig: { placement: "bottom-end" },
    })
);
const tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-te-toggle="tooltip"]')
);
tooltipTriggerList.map((el) =>
    Tooltip.getOrCreateInstance(el, { trigger: "hover", offset: [0, 8] })
);
