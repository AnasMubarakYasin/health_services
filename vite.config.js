import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { fdir } from "fdir";
import path from "path";
// import { ivi } from "@ivi/vite-plugin";

const css = new fdir().withFullPaths().crawl("resources/css").sync();
const js = new fdir().withFullPaths().crawl("resources/js").sync();

export default defineConfig({
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "resources/js"),
      "@components": path.resolve(__dirname, "resources/js/components"),
    },
  },
  plugins: [
    // ivi(),
    laravel({
      input: [...css, ...js],
      refresh: true,
    }),
  ],
  esbuild: {
    supported: {
      "top-level-await": true,
    },
  },
});
