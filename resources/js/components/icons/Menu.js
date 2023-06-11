import { component } from "ivi";
import { htm } from "@ivi/htm";

const Menu = component((c) => {
  return (props) => (
    htm`
      <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path fill="currentColor"
          d="M120-240v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z" />
      </svg>`
  );
});

export default Menu;