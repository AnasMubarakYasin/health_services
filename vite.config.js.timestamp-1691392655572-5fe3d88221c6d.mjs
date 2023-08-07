// vite.config.js
import { defineConfig } from "file:///media/anas/Data/projects/main/health_services/node_modules/vite/dist/node/index.js";
import laravel from "file:///media/anas/Data/projects/main/health_services/node_modules/laravel-vite-plugin/dist/index.mjs";
import { fdir } from "file:///media/anas/Data/projects/main/health_services/node_modules/fdir/dist/index.js";
import path from "path";
import { ivi } from "file:///media/anas/Data/projects/main/health_services/node_modules/@ivi/vite-plugin/dist/index.js";
var __vite_injected_original_dirname = "/media/anas/Data/projects/main/health_services";
var css = new fdir().withFullPaths().crawl("resources/css").sync();
var js = new fdir().withFullPaths().crawl("resources/js").sync();
var vite_config_default = defineConfig({
  resolve: {
    alias: {
      "@": path.resolve(__vite_injected_original_dirname, "resources/js"),
      "@components": path.resolve(__vite_injected_original_dirname, "resources/js/components")
    }
  },
  plugins: [
    ivi(),
    laravel({
      input: [...css, ...js],
      refresh: true
    })
  ],
  esbuild: {
    supported: {
      "top-level-await": true
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvbWVkaWEvYW5hcy9EYXRhL3Byb2plY3RzL21haW4vaGVhbHRoX3NlcnZpY2VzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCIvbWVkaWEvYW5hcy9EYXRhL3Byb2plY3RzL21haW4vaGVhbHRoX3NlcnZpY2VzL3ZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9tZWRpYS9hbmFzL0RhdGEvcHJvamVjdHMvbWFpbi9oZWFsdGhfc2VydmljZXMvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tIFwidml0ZVwiO1xuaW1wb3J0IGxhcmF2ZWwgZnJvbSBcImxhcmF2ZWwtdml0ZS1wbHVnaW5cIjtcbmltcG9ydCB7IGZkaXIgfSBmcm9tIFwiZmRpclwiO1xuaW1wb3J0IHBhdGggZnJvbSBcInBhdGhcIjtcbmltcG9ydCB7IGl2aSB9IGZyb20gXCJAaXZpL3ZpdGUtcGx1Z2luXCI7XG5cbmNvbnN0IGNzcyA9IG5ldyBmZGlyKCkud2l0aEZ1bGxQYXRocygpLmNyYXdsKFwicmVzb3VyY2VzL2Nzc1wiKS5zeW5jKCk7XG5jb25zdCBqcyA9IG5ldyBmZGlyKCkud2l0aEZ1bGxQYXRocygpLmNyYXdsKFwicmVzb3VyY2VzL2pzXCIpLnN5bmMoKTtcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgcmVzb2x2ZToge1xuICAgIGFsaWFzOiB7XG4gICAgICBcIkBcIjogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgXCJyZXNvdXJjZXMvanNcIiksXG4gICAgICBcIkBjb21wb25lbnRzXCI6IHBhdGgucmVzb2x2ZShfX2Rpcm5hbWUsIFwicmVzb3VyY2VzL2pzL2NvbXBvbmVudHNcIiksXG4gICAgfSxcbiAgfSxcbiAgcGx1Z2luczogW1xuICAgIGl2aSgpLFxuICAgIGxhcmF2ZWwoe1xuICAgICAgaW5wdXQ6IFsuLi5jc3MsIC4uLmpzXSxcbiAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgfSksXG4gIF0sXG4gIGVzYnVpbGQ6IHtcbiAgICBzdXBwb3J0ZWQ6IHtcbiAgICAgIFwidG9wLWxldmVsLWF3YWl0XCI6IHRydWUsXG4gICAgfSxcbiAgfSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUE0VCxTQUFTLG9CQUFvQjtBQUN6VixPQUFPLGFBQWE7QUFDcEIsU0FBUyxZQUFZO0FBQ3JCLE9BQU8sVUFBVTtBQUNqQixTQUFTLFdBQVc7QUFKcEIsSUFBTSxtQ0FBbUM7QUFNekMsSUFBTSxNQUFNLElBQUksS0FBSyxFQUFFLGNBQWMsRUFBRSxNQUFNLGVBQWUsRUFBRSxLQUFLO0FBQ25FLElBQU0sS0FBSyxJQUFJLEtBQUssRUFBRSxjQUFjLEVBQUUsTUFBTSxjQUFjLEVBQUUsS0FBSztBQUVqRSxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUMxQixTQUFTO0FBQUEsSUFDUCxPQUFPO0FBQUEsTUFDTCxLQUFLLEtBQUssUUFBUSxrQ0FBVyxjQUFjO0FBQUEsTUFDM0MsZUFBZSxLQUFLLFFBQVEsa0NBQVcseUJBQXlCO0FBQUEsSUFDbEU7QUFBQSxFQUNGO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDUCxJQUFJO0FBQUEsSUFDSixRQUFRO0FBQUEsTUFDTixPQUFPLENBQUMsR0FBRyxLQUFLLEdBQUcsRUFBRTtBQUFBLE1BQ3JCLFNBQVM7QUFBQSxJQUNYLENBQUM7QUFBQSxFQUNIO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDUCxXQUFXO0FBQUEsTUFDVCxtQkFBbUI7QUFBQSxJQUNyQjtBQUFBLEVBQ0Y7QUFDRixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
