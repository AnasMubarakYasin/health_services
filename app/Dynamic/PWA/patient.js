const colors = require("tailwindcss/colors");
const assets = require("./assets.js");

module.exports = {
  // id: "/patient/",
  dir: "ltr",
  lang: "en",
  name: process.env.APP_NAME,
  scope: "/patient/",
  display: "standalone",
  start_url: "/patient/dashboard",
  short_name: process.env.APP_NAME,
  theme_color: colors.blue[500],
  description: "Web application for ordering healthcare services",
  orientation: "any",
  background_color: colors.blue[500],
  related_applications: [
    {
      platform: "webapp",
      url: `${process.env.APP_URL}/patient/site.webmanifest`,
    },
  ],
  prefer_related_applications: false,
  display_override: ["window-controls-overlay", "standalone", "minimal-ui"],
  screenshots: [
    {
      src: "/images/screenshots/patient_dashboard.png",
    },
    {
      src: "/images/screenshots/patient_dashboard_mobile.jpg",
    },
  ],
  features: ["Cross Platform", "Booking"],
  request_on_install: ["runonstartup"],
  icons: assets.icons,
  categories: ["medical"],
  launch_handler: {
    client_mode: "navigate-existing",
  },
  edge_side_panel: {},
  shortcuts: [
    {
      name: "Order Service",
      short_name: "Order Service",
      description: "Ordering a service",
      url: "/patient/order",
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
      url: "/patient/history",
      // icons: [
      //   {
      //     src: "/icons/logo/proto-512.v2.png",
      //     sizes: "512x512",
      //   },
      // ],
    },
  ],
};
