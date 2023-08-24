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
