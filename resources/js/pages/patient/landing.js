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
});

if (panel) {
  var APP_CTX_KEY = "f456grty";

  const ctx = Context.create(APP_CTX_KEY);

  ctx.init();

  console.log("home init");
  console.log(panel);

  axios.defaults.headers.common["Authorization"] = `Bearer ${panel.token}`;
}
