import { Workbox } from "workbox-window";
import { Dismiss } from "flowbite";
import { Toast, initTE } from "tw-elements";
import { create_element } from "@/lib/helper";

window.Toast = Toast;

if ("serviceWorker" in navigator) {
  let prompted_install = false;
  let prompted_update = false;
  const wb = new Workbox("/patient/sw.js", {
    type: "module",
    scope: "/patient/",
  });
  window.addEventListener("beforeinstallprompt", (event) => {
    event.preventDefault();
    if (localStorage.getItem("template") == "simple") {
      const toast = create_element(gen_simple_prompt_install());
      const dismiss = new Dismiss(toast, toast.querySelector("#close-btn"));

      prompted_install = true;
      document.getElementById("main").prepend(toast);
      toast.querySelector("#install-btn").addEventListener("click", () => {
        event.prompt();
        dismiss.hide();
      });
    } else {
      const toast = create_element(gen_modern_prompt_install());
      document.getElementById("main").prepend(toast);
      initTE({ Toast });
      toast.querySelector("#install-btn").addEventListener("click", () => {
        event.prompt();
        Toast.getInstance(toast).hide();
      });
    }
  });
  wb.addEventListener("waiting", (event) => {
    wb.addEventListener("controlling", (event) => {
      window.location.reload();
    });
    if (localStorage.getItem("template") == "simple") {
      const toast = create_element(gen_simple_prompt_update());
      const dismiss = new Dismiss(toast, toast.querySelector("#close-btn"), {
        onHide() {
          if (prompted_install) {
            document.getElementById("prompt-install").style.display = "block";
          }
        },
      });

      if (prompted_install) {
        document.getElementById("prompt-install").style.display = "none";
      }

      prompted_update = true;
      document.getElementById("main").prepend(toast);
      toast.querySelector("#update-btn").addEventListener("click", () => {
        wb.messageSkipWaiting();
        dismiss.hide();
      });
    } else {
      const toast = create_element(gen_modern_prompt_update());
      document.getElementById("main").prepend(toast);
      initTE({ Toast });

      toast.querySelector("#update-btn").addEventListener("click", () => {
        wb.messageSkipWaiting();
        Toast.getInstance(toast).hide();
      });
    }
  });
  wb.register({ immediate: true }).then((swr) => {});
}
function gen_modern_prompt_install() {
  return `
  <div
    class="fixed top-20 right-4 z-10 pointer-events-auto hidden w-full max-w-xs rounded-lg bg-clip-padding text-sm shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden bg-base-100 text-base-content"
    id="propmt-install"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-te-autohide="false"
    data-te-toast-init
    data-te-toast-show
  >
    <div
      class="flex items-center justify-between rounded-t-lg border-b-2 border-base-200 bg-clip-padding px-4 pb-2 pt-2.5"
    >
      <p class="font-bold">
        Install Application
      </p>
      <div class="flex items-center">
        <button
          type="button"
          class="ml-2 box-content rounded-none border-none opacity-80 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
          data-te-toast-dismiss
          aria-label="Close">
          <span
            class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="h-6 w-6">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </span>
        </button>
      </div>
    </div>
    <div
      class="flex flex-col gap-4 break-words rounded-b-lg px-4 py-4">
      <div>This site can be installed as an application.</div>
      <div class="self-end flex gap-4">
        <button
          id="install-btn"
          type="button"
          class="inline-block rounded bg-primary text-primary-content px-5 py-1 text-sm font-medium leading-normal transition duration-150 ease-in-out hover:bg-primary-focus"
        >
          Install
        </button>
        <button
          data-te-toast-dismiss
          id="close-btn"
          type="button"
          class="inline-block rounded bg-base-300/70 text-base-content px-5 py-1 text-sm font-medium leading-normal transition duration-150 ease-in-out hover:bg-base-300"
        >
          Later
        </button>
      </div>
    </div>
  </div>
  `;
}
function gen_modern_prompt_update() {
  return `
  <div
    class="fixed top-20 right-4 z-10 pointer-events-auto hidden w-full max-w-xs rounded-lg bg-clip-padding text-sm shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden bg-base-100 text-base-content"
    id="propmt-install"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-te-autohide="false"
    data-te-toast-init
    data-te-toast-show
  >
    <div
      class="flex items-center justify-between rounded-t-lg border-b-2 border-base-200 bg-clip-padding px-4 pb-2 pt-2.5"
    >
      <p class="font-bold">
        Update Application
      </p>
      <div class="flex items-center">
        <button
          type="button"
          class="ml-2 box-content rounded-none border-none opacity-80 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
          data-te-toast-dismiss
          aria-label="Close">
          <span
            class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="h-6 w-6">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </span>
        </button>
      </div>
    </div>
    <div
      class="flex flex-col gap-4 break-words rounded-b-lg px-4 py-4">
      <div>A new updates is available to application.</div>
      <div class="self-end flex gap-4">
        <button
          id="update-btn"
          type="button"
          class="inline-block rounded bg-primary text-primary-content px-5 py-1 text-sm font-medium leading-normal transition duration-150 ease-in-out hover:bg-primary-focus"
        >
          Update
        </button>
        <button
          data-te-toast-dismiss
          id="close-btn"
          type="button"
          class="inline-block rounded bg-base-300/70 text-base-content px-5 py-1 text-sm font-medium leading-normal transition duration-150 ease-in-out hover:bg-base-300"
        >
          Later
        </button>
      </div>
    </div>
  </div>
  `;
}
function gen_simple_prompt_install() {
  return `
        <div
            id="prompt-install"
            class="fixed bottom-5 right-5 z-20 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-all-lg dark:bg-gray-800 dark:text-gray-400"
            role="alert"
        >
            <div class="flex">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:text-blue-300 dark:bg-blue-900">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-5 h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25"
                        />
                    </svg>
                    <span class="sr-only">Refresh icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">
                    <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">
                        Install Application
                    </span>
                    <div class="mb-2 text-sm font-normal">
                        This site can be installed as an application.
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <button
                                id="install-btn"
                                class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                            >
                                Install
                            </button>
                        </div>
                        <div>
                            <button
                                id="close-btn"
                                class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700"
                            >
                                Not now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}
function gen_simple_prompt_update() {
  return `
        <div
            id="prompt-update"
            class="fixed bottom-5 right-5 z-20 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-xl dark:bg-gray-800 dark:text-gray-400"
            role="alert"
        >
            <div class="flex">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:text-blue-300 dark:bg-blue-900">
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Refresh icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">
                    <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">
                        Update content available
                    </span>
                    <div class="mb-2 text-sm font-normal">
                        A new content is available for download.
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <button
                                id="update-btn"
                                class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                            >
                                Update
                            </button>
                        </div>
                        <div>
                            <button
                                id="close-btn"
                                class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700"
                            >
                                Not now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}
