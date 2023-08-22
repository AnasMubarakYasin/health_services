const colors = require('tailwindcss/colors');
const assets = require('./assets.js');

module.exports = {
  id: "/",
  dir: "ltr",
  lang: "en",
  name: "Health Services",
  scope: "/patient/",
  display: "standalone",
  start_url: "/patient/dashboard",
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
      src: "/images/screenshots/patient_dashboard.png",
    },
  ],
  features: ["Cross Platform", "Booking"],
  icons: assets.icons,
  categories: ["medical"],
  launch_handler: {
    client_mode: "navigate-existing",
  },
  edge_side_panel: {},
  shortcuts: [
    {
      name: "Order Services",
      short_name: "Order",
      description: "Order services",
      url: "/patient/dashboard/order",
      icons: [
        {
          src: "/icons/logo/proto-512.v2.png",
          sizes: "512x512",
        },
      ],
    },
  ],
};
