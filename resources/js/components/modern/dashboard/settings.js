import Context from "@/lib/context";

var APP_CTX_KEY = "f456grty";

const ctx = Context.get(APP_CTX_KEY);
const data = {};

await ctx.inited();

console.log("settings init");

ctx.sync_state("settings", data, (value) => Object.assign(data, value));

const subscribe_elm = document.getElementById("subscribe");
const service_worker = await navigator.serviceWorker.getRegistration();
let subscribtion = await service_worker.pushManager.getSubscription();

if (subscribtion) {
  subscribe_elm.checked = await ctx.action.regis_sw.subscribed(subscribtion);
}
subscribe_elm.addEventListener("change", async (event) => {
  subscribe_elm.disabled = true;
  progress.start();
  if (subscribe_elm.checked) {
    subscribtion = await ctx.action.regis_sw.create_subscribtion(
      service_worker
    );
    await ctx.action.regis_sw.subscribe(subscribtion);
  } else {
    subscribtion && (await ctx.action.regis_sw.unsubscribe(subscribtion));
  }
  progress.finish();
  subscribe_elm.disabled = false;
});

const install_elm = document.getElementById("install");
const apps = (await navigator.getInstalledRelatedApps?.()) ?? [];
console.log(apps);
install_elm.checked = !!apps.length;
