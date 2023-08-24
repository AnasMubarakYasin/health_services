import Context from "@/lib/context";

var APP_CTX_KEY = "f456grty";

const ctx = Context.get(APP_CTX_KEY);
const data = {
  font_family: "sans",
  color_scheme: "light",
};

await ctx.inited();

console.log("settings init");

ctx.sync_state("settings", data, (value) => Object.assign(data, value));

// console.log(subscriptions);
console.log(await navigator.getInstalledRelatedApps?.());

const service_worker = await navigator.serviceWorker.getRegistration();
const subscribtion = await service_worker.pushManager.getSubscription();
const subscribe_elm = document.getElementById("subscribe");

// console.log(subscribtion);

if (subscribtion) {
  subscribe_elm.checked = subscriptions.some(
    (item) => item.endpoint == subscribtion.endpoint
  );
}
