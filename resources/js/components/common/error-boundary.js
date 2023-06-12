import { component, createRoot, update, invalidate, useState } from "ivi";
import { htm } from "@ivi/htm";

const root = createRoot(document.body);
const ToastGroup = component((c) => {
  const [get, set] = useState(c, []);
  addEventListener("error", (ev) => {
    let state = get();
    const url = new URL(`${ev.filename}:${ev.lineno}:${ev.colno}`);
    const link = url.href.replace(url.origin, `vscode://file` + panel.pwd);
    state.push({ message: ev.message, link });
    set(state);
    invalidate(c);
    setTimeout(() => {
      let state = get();
      state.shift();
      set(state);
      invalidate(c);
    }, 3000);
  });
  addEventListener("rejectionhandled", (ev) => {});
  return () => {
    return htm/*html*/ `
      <div id="ToastErrorBoundary" class="toast toast-end z-20">
        ${get().map((error) => Alert(error))}
      </div>`;
  };
});
const Alert = component((c) => {
  return ({ message, link }) => {
    return htm/*html*/ `
            <div class="w-fit bg-base-100 rounded-2xl shadow-2xl">
              <div class="alert alert-error py-3 ">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class=" w-8 h-8">
                      <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="flex flex-col">
                      <div class="font-medium">Error! ${message}.</div>
                  </span>
                  <div class="self-center">
                      <div class="tooltip" data-tip="open">
                          <a href=${link} class="btn btn-square btn-sm btn-primary text-primary-content">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                  stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                              </svg>
                          </a>
                        </div>
                  </div>
              </div>
            </div>`;
  };
});

update(root, ToastGroup());
