const colors = require("tailwindcss/colors");
const assets = require("./assets.js");

module.exports = {
  // id: "/midwife/",
  dir: "ltr",
  lang: "en",
  name: `${process.env.APP_NAME} for Midwife`,
  scope: "/midwife/",
  display: "standalone",
  start_url: "/midwife/dashboard",
  short_name: `${process.env.APP_NAME} (Midwife)`,
  theme_color: colors.blue[500],
  description: "Web application for ordering healthcare services",
  orientation: "any",
  background_color: colors.blue[500],
  related_applications: [
    {
      platform: "webapp",
      url: `${process.env.APP_URL}/midwife/site.webmanifest`,
    },
  ],
  prefer_related_applications: false,
  display_override: ["window-controls-overlay", "standalone", "minimal-ui"],
  screenshots: [
    {
      src: "/images/screenshots/midwife_dashboard.png",
      sizes: "1321x626",
    },
    {
      src: "/images/screenshots/midwife_dashboard_mobile.jpg",
      sizes: "1080x2340",
    },
  ],
  features: ["Cross Platform"],
  request_on_install: ["runonstartup"],
  icons: assets.icons,
  categories: ["medical"],
  launch_handler: {
    client_mode: "navigate-existing",
  },
  edge_side_panel: {},
  shortcuts: [
    {
      name: "Add Schedule",
      short_name: "Add Schedule",
      description: "Add schedule for orders",
      url: "/midwife/schedule/create",
      // icons: [
      //   {
      //     src: "/icons/logo/proto-512.v2.png",
      //     sizes: "512x512",
      //   },
      // ],
    },
    {
      name: "Show History",
      short_name: "Show History",
      description: "List all orders",
      url: "/midwife/history",
      // icons: [
      //   {
      //     src: "/icons/logo/proto-512.v2.png",
      //     sizes: "512x512",
      //   },
      // ],
    },
  ],
};
