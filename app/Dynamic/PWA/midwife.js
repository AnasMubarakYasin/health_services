const colors = require("tailwindcss/colors");
const assets = require("./assets.js");

module.exports = {
  id: "/midwife/",
  dir: "ltr",
  lang: "en",
  name: "Health Services for Midwife",
  scope: "/midwife/",
  display: "standalone",
  start_url: "/midwife/dashboard",
  short_name: "Heavice",
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
    },
  ],
  features: ["Cross Platform"],
  icons: assets.icons,
  categories: ["medical"],
  launch_handler: {
    client_mode: "navigate-existing",
  },
  edge_side_panel: {},
  shortcuts: [
    {
      name: "Add Schedule",
      short_name: "Schedule",
      description: "Add Schedule",
      url: "/midwife/schedule/create",
      icons: [
        {
          src: "/icons/logo/proto-512.v2.png",
          sizes: "512x512",
        },
      ],
    },
  ],
};
