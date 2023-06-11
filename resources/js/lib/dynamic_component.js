import { createRoot, update } from "ivi";

export function create_renderer(fragment, components) {
    const fragment_ctr = document.getElementById(fragment);
    const recursive_render_component = (parent) => {
        const elm_now = document.querySelector("[data-component]");
        const component_name = elm_now?.dataset?.component;

        if (!elm_now || !component_name) return;

        // console.log("render", component_name);

        const attributes = {};

        elm_now.attributes.removeNamedItem("data-component");
        for (const attribute of elm_now.attributes) {
            attributes[attribute.name] = attribute.value;
        }

        update(createRoot(fragment_ctr), components[component_name](attributes));

        if (!fragment_ctr.children.length) return;

        const elm_new = fragment_ctr.firstElementChild;
        const elm_child = elm_now.querySelector("[data-component]");

        elm_new.remove();

        if (elm_child) {
            // console.log("render recur", elm_child.dataset.component);
            recursive_render_component(elm_new);
        }
        elm_now.replaceWith(elm_new);
        if (parent) {
            parent.append(elm_new);
        }
        return elm_new;
    }
    return recursive_render_component;
}