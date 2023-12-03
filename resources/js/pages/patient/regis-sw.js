import { Workbox } from "workbox-window";

import Context from "@/lib/context";
import { create_prompt } from "@/components/common/prompt";
import { Promiseify, urlBase64ToUint8Array } from "@/lib/helper";

if ("serviceWorker" in navigator) {
  const APP_CTX_KEY = "f456grty";
  const ctx = Context.get_or_create(APP_CTX_KEY);
  const data = {};

  ctx.inited();

  console.log("regis_sw init");

  ctx.sync_state("regis_sw", data, (value) => Object.assign(data, value));
  ctx.action.regis_sw = {
    subscribe,
    subscribed,
    unsubscribe,
    create_subscribtion,
  };

  let prompted_install = false;
  let prompted_update = false;
  let prompted_notification = false;
  const wb = new Workbox("/sw.js", {
    type: "module",
    scope: "/",
  });
  const prompt = create_prompt();
  window.addEventListener("beforeinstallprompt", (event) => {
    event.preventDefault();
    // console.log(event);
    // event.userChoice.then(console.log);

    prompted_install = true;
    prompt.install.show();
    prompt.install.onAccept = function () {
      event.prompt();
    };
  });
  wb.addEventListener("waiting", (event) => {
    wb.addEventListener("controlling", (event) => {
      window.location.reload();
    });
    prompted_update = true;
    prompt.update.show();
    prompt.update.onAccept = function () {
      wb.messageSkipWaiting();
    };
    if (prompted_install) {
      prompt.install.hide();
    }
    if (prompted_notification) {
      prompt.notification.hide();
    }
  });
  const service_worker = await wb.register({ immediate: true });
  if (!service_worker.active) {
    const activated = new Promiseify();
    wb.addEventListener("activated", (event) => {
      activated.resolver();
    });
    await activated;
  }
  if ("Notification" in window) {
    const permissions = await navigator.permissions.query({
      name: "notifications",
    });
    const granted = new Promiseify();
    if (Notification.permission == "default") {
      prompted_notification = true;
      prompt.notification.show();
      prompt.notification.onAccept = function () {
        Notification.requestPermission();
      };
      permissions.addEventListener("change", (event) => {
        if (Notification.permission == "granted") {
          granted.resolver();
        }
      });
      await granted;
    }
    let subscribtion = await service_worker.pushManager.getSubscription();
    if (!subscribtion) {
      subscribtion = await create_subscribtion(service_worker);
    }
    if (subscribtion) {
      // console.log(subscribtion);
      if (!subscribed(subscribtion)) {
        subscribe(subscribtion);
      }
    }
  }
  async function create_subscribtion(service_worker) {
    const res = await axios.get("/api/webpush/public_key");
    const public_key = urlBase64ToUint8Array(res.data);
    let subscribtion = null;
    // subscribtion = await service_worker.pushManager.subscribe({
    //   userVisibleOnly: true,
    //   applicationServerKey: public_key,
    // });
    try {
      subscribtion = await service_worker.pushManager.subscribe({
        userVisibleOnly: false,
        applicationServerKey: public_key,
      });
    } catch (error) {
      subscribtion = await service_worker.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: public_key,
      });
    }
    return subscribtion;
  }
  async function subscribe(subscribtion) {
    await axios.post("/api/webpush/subscribe", subscribtion);
  }
  async function subscribed(subscribtion) {
    const res = await axios.get(
      "/api/webpush/subscribed?endpoint=" + subscribtion.endpoint
    );
    return res.data;
  }
  async function unsubscribe(subscribtion) {
    const res = await axios.delete(
      "/api/webpush/unsubscribe?endpoint=" + subscribtion.endpoint
    );
  }
}
