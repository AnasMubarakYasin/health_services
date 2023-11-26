import "../../../css/map.css";

import L from "leaflet";
import { GeoSearchControl, OpenStreetMapProvider } from "leaflet-geosearch";

if (history.state?.request == "select") {
} else {
  history.back();
}

const value = {
  coordinates: [],
  address: "",
};
const provider = new OpenStreetMapProvider({
  params: {
    "accept-language": "id", // render results in Dutch
    countrycodes: "id", // limit search results to the Netherlands
    addressdetails: 1, // include additional address detail parts
  },
});
const searchControl = new GeoSearchControl({
  provider: provider,
  style: "bar",
});
const coordinate = [-5.152, 119.437];
const corner1 = L.latLng(-4.894023327947126, 119.11651611328126);
const corner2 = L.latLng(-5.4866649580971165, 119.83612060546876);
const map_bounds = L.latLngBounds(corner1, corner2);
const popup = L.popup();
const marker = L.marker(coordinate);
// const circle = L.circle([-5.137473860368934, 119.43991751672354], {
//   radius: 2e3 / 2,
// });
const map = L.map("map").setView(coordinate, 13);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  minZoom: 10,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

map.setMaxBounds(map_bounds);
map.addControl(searchControl);
marker.addTo(map);
// circle.addTo(map);

L.Control.CurrentLocation = L.Control.extend({
  onAdd: function (map) {
    var btn = L.DomUtil.create("a");

    btn.title = "Current Position";
    btn.role = "button";
    btn.className = "btn-curr";
    btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
  </svg>`;

    btn.addEventListener("click", (e) => {
      navigator.geolocation.getCurrentPosition(
        async (position) => {
          const results = await provider.search({
            query: `${position.coords.latitude},${position.coords.longitude}`,
          });
          // console.log(results);
          select_elm.disabled = false;
          marker.setLatLng([
            position.coords.latitude,
            position.coords.longitude,
          ]);
          value.coordinates = [
            position.coords.latitude,
            position.coords.longitude,
          ];
          value.address = results.at(0).label;
          map.flyTo([position.coords.latitude, position.coords.longitude]);
        },
        (error) => {
          throw error;
        }
      );
    });

    L.DomEvent.disableClickPropagation(btn);
    return btn;
  },
  onRemove: function (map) {},
});
L.control.currentLocation = function (opts) {
  return new L.Control.CurrentLocation(opts);
};
L.control.currentLocation({ position: "topleft" }).addTo(map);

map.on("click", onMapClick);
map.on("geosearch/showlocation", onShow);
map.on("geosearch/marker/dragend", onDrag);

async function onMapClick(e) {
  // console.log(e.latlng);
  // console.log(circle_bounds.contains(e.latlng));
  // console.log(circle.getBounds().contains(e.latlng))

  // console.log(e);
  marker.setLatLng(e.latlng);
  const results = await provider.search({
    query: `${e.latlng.lat},${e.latlng.lng}`,
  });
  value.coordinates = [e.latlng.lat, e.latlng.lng];
  value.address = results.at(0).label;
  select_elm.disabled = false;
}
function onShow(e) {
  // console.log(e);
  e.marker.remove();
  marker.setLatLng([e.location.y, e.location.x]);
  value.coordinates = [e.location.y, e.location.x];
  value.address = e.location.label;
  select_elm.disabled = false;
}
function onDrag(e) {}

// console.log(history.state);
const select_elm = document.getElementById("select");
select_elm.addEventListener("click", (ev) => {
  const source = history.state.source;
  history.pushState({ result: value, data: history.state?.data }, "", source);
  location.assign(source);
});
const cancel_elm = document.getElementById("cancel");
cancel_elm.addEventListener("click", (ev) => {
  const source = history.state.source;
  history.back();
  location.assign(source);
});
