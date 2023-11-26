import L from "leaflet";

coord = JSON.parse(coord);
console.log(coord)
const coordinate = [-5.152, 119.437];
var corner1 = L.latLng(-4.894023327947126, 119.11651611328126),
  corner2 = L.latLng(-5.4866649580971165, 119.83612060546876),
  bounds = L.latLngBounds(corner1, corner2);
// const popup = L.popup();
const marker = L.marker(coord);
const map = L.map("map").setView(coordinate, 13);
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  minZoom: 10,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

map.setMaxBounds(bounds);
marker.addTo(map);
