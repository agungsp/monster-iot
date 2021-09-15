window.map = null;
window.mapIcon = null;
window.mapMarkers = [];

window.createMap = (centerPoint = null) => {
    window.map = L.map("map").setView(centerPoint ?? [-7.31513, 112.79084], 10);
    window.mapIcon = L.icon({
        iconUrl: "../images/marker-icon.png",
        iconSize: [29, 45],
        iconAnchor: [15, 47],
        popupAnchor: [0, 0],
        shadowUrl: "../images/marker-shadow.png",
        shadowSize: [37, 40],
        shadowAnchor: [12, 42],
    });
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(window.map);
};

window.addMarker = (name, latlon) => {
    let marker = {};
    marker[name] = {
        latlon: latlon,
        marker: L.marker(latlon, {
            icon: window.mapIcon,
        }).addTo(window.map),
    };
    window.mapMarkers.push(marker);
};

window.showMarker = (name) => {
    let keys = Object.keys(window.mapMarkers);
    return keys.indexOf(name) < 0 ? null : window.mapMarkers[name];
};
