import "../../../css/map.css";

import L from "leaflet";
import { GeoSearchControl, OpenStreetMapProvider } from "leaflet-geosearch";

console.log(address, bounds, coordinates, distance);

const value = {
  coordinates: JSON.parse(coordinates),
  address: address,
  distance: distance * 1e3,
  bounds: JSON.parse(bounds),
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
const default_coordinates = [-5.152, 119.437];
const corner1 = L.latLng(-4.894023327947126, 119.11651611328126);
const corner2 = L.latLng(-5.4866649580971165, 119.83612060546876);
const map_bounds = L.latLngBounds(corner1, corner2);
const map = L.map("map").setView(value.coordinates ?? default_coordinates, 13);
const marker = L.marker(value.coordinates ?? default_coordinates);
const circle = L.circle(value.coordinates ?? default_coordinates, {
  // color: "#3eb4ff",
  // fillColor: "#0494ef",
  // fillOpacity: 0.3,
  radius: value.distance / 2,
});
// const popup = L.popup();

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  minZoom: 10,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

map.setMaxBounds(map_bounds);
map.addControl(searchControl);
marker.addTo(map);
circle.addTo(map);

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
      navigator.geolocation.getCurrentPosition(onCurrPos, (error) => {
        throw error;
      });
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

async function onMapClick(e) {
  marker.setLatLng(e.latlng);
  circle.setLatLng(e.latlng);
  const results = await provider.search({
    query: `${e.latlng.lat},${e.latlng.lng}`,
  });
  value.coordinates = [e.latlng.lat, e.latlng.lng];
  value.address = results.at(0).label;
  value.bounds = circle.getBounds();
  update_elm.disabled = false;
}
function onShow(e) {
  e.marker.remove();
  marker.setLatLng([e.location.y, e.location.x]);
  circle.setLatLng([e.location.y, e.location.x]);
  value.coordinates = [e.location.y, e.location.x];
  value.address = e.location.label;
  value.bounds = circle.getBounds();
  update_elm.disabled = false;
}
async function onCurrPos(position) {
  const results = await provider.search({
    query: `${position.coords.latitude},${position.coords.longitude}`,
  });
  marker.setLatLng([position.coords.latitude, position.coords.longitude]);
  circle.setLatLng([position.coords.latitude, position.coords.longitude]);
  value.coordinates = [position.coords.latitude, position.coords.longitude];
  value.address = results.at(0).label;
  value.bounds = circle.getBounds();
  update_elm.disabled = false;
  map.flyTo([position.coords.latitude, position.coords.longitude]);
}

const form_elm = document.getElementById("form");
const update_elm = document.getElementById("update");
const distance_elm = document.getElementById("input_distance");

update_elm.disabled = true;
distance_elm.value = value.distance / 1e3;

form_elm.addEventListener("submit", (ev) => {
  form.elements.bounds.value = JSON.stringify(value.bounds);
  form.elements.address.value = value.address;
  form.elements.coordinates.value = JSON.stringify(value.coordinates);
});
distance_elm.addEventListener("change", (ev) => {
  value.distance = distance_elm.value * 1e3;
  circle.setRadius(value.distance / 2);
  value.bounds = circle.getBounds();
});
