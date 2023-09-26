import Context from "@/lib/context";

import {
  Animate,
  Ripple,
  Tab,
  Sidenav,
  Collapse,
  Dropdown,
  Tooltip,
  Button,
  Select,
  Modal,
  initTE,
} from "tw-elements";

initTE({
  // Animate,
  Ripple,

  Tab,
  // Sidenav,
  Collapse,
  Dropdown,
  // Tooltip,

  // Button,
  Select,
  Modal,
});

var APP_CTX_KEY = "f456grty";

const ctx = Context.create(APP_CTX_KEY);

ctx.init();

console.log("dashboard init");
console.log(panel);

axios.defaults.headers.common["Authorization"] = `Bearer ${panel.token}`;

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

// addEventListener('DOMContentLoaded', () => {
//   document.body.classList.remove('opacity-0');
//   document.body.classList.add('opacity-100');
// })
// addEventListener('load', () => {
//   document.body.style.transitionDuration = "1s";
//   document.body.classList.remove('opacity-0');
//   document.body.classList.add('opacity-100');
// })
// addEventListener('beforeunload', () => {
//   document.body.style.transitionDuration = "300ms";
//   document.body.classList.add('opacity-0');
//   document.body.classList.remove('opacity-100');
// })
