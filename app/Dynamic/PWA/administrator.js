const colors = require('tailwindcss/colors');
const assets = require('./assets.js');

module.exports = {
  id: "/",
  dir: "ltr",
  lang: "en",
  name: `${process.env.APP_NAME} for Administrator`,
  scope: "/administrator/",
  display: "standalone",
  start_url: "/administrator/dashboard",
  short_name: "Heavice",
  theme_color: colors.blue[500],
  description: "Web application for ordering healthcare services",
  orientation: "any",
  background_color: colors.blue[500],
  related_applications: [],
  prefer_related_applications: false,
  display_override: ["window-controls-overlay", "standalone", "minimal-ui"],
  screenshots: [
    {
      src: "/images/screenshots/administrator_dashboard.png",
    },
  ],
  features: ["Cross Platform"],
  icons: assets.icons,
  categories: ["medical"],
  launch_handler: {
    client_mode: "navigate-existing",
  },
  edge_side_panel: {},
  shortcuts: [],
};
