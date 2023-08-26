import { Dismiss } from "flowbite";
import { Toast, initTE } from "tw-elements";
import {
  create_element,
} from "@/lib/helper";

export function create_prompt() {
  const install = { show() {}, hide() {}, onAccept() {} };
  const update = { show() {}, hide() {}, onAccept() {} };
  const notification = { show() {}, hide() {}, onAccept() {} };
  const toast_install = create_element(gen_prompt_install());
  const toast_update = create_element(gen_prompt_update());
  const toast_notification = create_element(gen_prompt_notification());
  document
    .getElementById("main")
    .prepend(toast_install, toast_update, toast_notification);
  toast_install.querySelector("#install-btn").addEventListener("click", () => {
    install.hide();
    install.onAccept();
  });
  toast_update.querySelector("#update-btn").addEventListener("click", () => {
    update.hide();
    update.onAccept();
  });
  toast_notification
    .querySelector("#notification-btn")
    .addEventListener("click", () => {
      notification.hide();
      notification.onAccept();
    });
  if (localStorage.getItem("template") == "simple") {
    const dismiss_install = new Dismiss(
      toast_install,
      toast_install.querySelector("#close-btn")
    );
    install.show = function () {
      toast_install.style.display = "block";
      requestAnimationFrame(() => {
        toast_install.style.opacity = "1";
      });
    };
    install.hide = function () {
      dismiss_install.hide();
    };
    const dismiss_update = new Dismiss(
      toast_update,
      toast_update.querySelector("#close-btn")
    );
    update.show = function () {
      toast_update.style.display = "block";
      requestAnimationFrame(() => {
        toast_update.style.opacity = "1";
      });
    };
    update.hide = function () {
      dismiss_update.hide();
    };
    const dismiss_notification = new Dismiss(
      toast_notification,
      toast_notification.querySelector("#close-btn")
    );
    notification.show = function () {
      toast_notification.style.display = "block";
      requestAnimationFrame(() => {
        toast_notification.style.opacity = "1";
      });
    };
    notification.hide = function () {
      dismiss_notification.hide();
    };
  } else {
    initTE({ Toast });
    install.show = function () {
      Toast.getInstance(toast_install).show();
    };
    install.hide = function () {
      Toast.getInstance(toast_install).hide();
    };
    update.show = function () {
      Toast.getInstance(toast_update).show();
    };
    update.hide = function () {
      Toast.getInstance(toast_update).hide();
    };
    notification.show = function () {
      Toast.getInstance(toast_notification).show();
    };
    notification.hide = function () {
      Toast.getInstance(toast_notification).hide();
    };
  }

  return {
    install,
    update,
    notification,
  };
}
function gen_prompt_install() {
  if (localStorage.getItem("template") == "simple") {
    return gen_simple_prompt_install();
  } else {
    return gen_modern_prompt_install();
  }
}
function gen_prompt_update() {
  if (localStorage.getItem("template") == "simple") {
    return gen_simple_prompt_update();
  } else {
    return gen_modern_prompt_update();
  }
}
function gen_prompt_notification() {
  if (localStorage.getItem("template") == "simple") {
    return gen_simple_prompt_notification();
  } else {
    return gen_modern_prompt_notification();
  }
}
function gen_modern_prompt_install() {
  return `
  <div
    class="fixed top-20 right-4 z-10 pointer-events-auto hidden w-full max-w-xs rounded-lg bg-clip-padding text-sm shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden bg-base-100 text-base-content"
    id="propmt-install"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-te-autohide="true"
    data-te-toast-init
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
    id="propmt-update"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-te-autohide="true"
    data-te-toast-init
  >
    <div
      class="flex items-center justify-between rounded-t-lg border-b-2 border-base-200 bg-clip-padding px-4 pb-2 pt-2.5"
    >
      <p class="font-bold">
        Update Application Content
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
      <div>A new content is available to application.</div>
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
function gen_modern_prompt_notification() {
  return `
  <div
    class="fixed top-20 right-4 z-10 pointer-events-auto hidden w-full max-w-xs rounded-lg bg-clip-padding text-sm shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden bg-base-100 text-base-content"
    id="propmt-notification"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-te-autohide="true"
    data-te-toast-init
  >
    <div
      class="flex items-center justify-between rounded-t-lg border-b-2 border-base-200 bg-clip-padding px-4 pb-2 pt-2.5"
    >
      <p class="font-bold">
        Allow Receive Notification
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
      <div>This site can show important message from notification.</div>
      <div class="self-end flex gap-4">
        <button
          id="notification-btn"
          type="button"
          class="inline-block rounded bg-primary text-primary-content px-5 py-1 text-sm font-medium leading-normal transition duration-150 ease-in-out hover:bg-primary-focus"
        >
          Allow
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
            class="hidden opacity-0 fixed bottom-5 right-5 z-20 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-all-lg dark:bg-gray-800 dark:text-gray-400 transition-opacity"
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
            class="hidden opacity-0 fixed bottom-5 right-5 z-20 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-all-lg dark:bg-gray-800 dark:text-gray-400 transition-opacity"
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
function gen_simple_prompt_notification() {
  return `
      <div
          id="prompt-notification"
          class="hidden opacity-0 fixed bottom-5 right-5 z-20 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-all-lg dark:bg-gray-800 dark:text-gray-400 transition-opacity"
          role="alert"
      >
          <div class="flex">
              <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:text-blue-300 dark:bg-blue-900">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
              </svg>
                  <span class="sr-only">RefresA new updates is available to application.h icon</span>
              </div>
              <div class="ml-3 text-sm font-normal">
                  <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">
                      Allow Receive Notification
                  </span>
                  <div class="mb-2 text-sm font-normal">
                      This site can show important message from notification.
                  </div>
                  <div class="grid grid-cols-2 gap-2">
                      <div>
                          <button
                              id="notification-btn"
                              class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                          >
                              Allow
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
