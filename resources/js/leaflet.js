require("leaflet/dist/leaflet");
let map = L.map("map").setView([-7.46311, 112.43192], 16);
let url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
let myIcon = L.icon({
    iconUrl: "../images/marker-icon.png",
    iconSize: [29, 45],
    iconAnchor: [15, 47],
    popupAnchor: [0, 0],
    shadowUrl: "../images/marker-shadow.png",
    shadowSize: [37, 40],
    shadowAnchor: [12, 42],
});
L.tileLayer(url, {
    maxZoom: 18,
    attribution:
        'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: "mapbox/streets-v11",
    tileSize: 512,
    zoomOffset: -1,
}).addTo(map);
L.marker([-7.46311, 112.43192], {
    icon: myIcon,
}).addTo(map);
