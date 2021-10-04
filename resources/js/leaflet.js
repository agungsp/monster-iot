window.map = null;
window.mapIcon = {};
window.mapMarkers = [];
window.latlon = [];
window.contextmenuLatLng = [];
window.geofenceInput = `<div class="m-3">
                            <label class="form-label" for="geofenceValue">Geofence radius (m)</label>
                            <input type="text" style="min-width:10rem;" value="50" class="form-control" id="geofenceValue">
                        </div>`;
window.markerNameInput = `<div class="m-3">
                              <label class="form-label" for="markerName">Marker Name (optional)</label>
                              <input type="text" style="min-width:10rem;" placeholder="(optional)" class="form-control" id="markerName">
                          </div>`;

window.createMap = (zoom = 10, centerPoint = null, geofances = []) => {
    window.map = L.map("map", {
        center: centerPoint ?? [-7.31513, 112.79084],
        zoom: zoom,
        contextmenu: true,
        contextmenuWidth: 140,
        contextmenuItems: [
            {
                text: 'Add Geofence',
                callback: () => {
                    let geofencePopup = L.popup()
                                         .setLatLng(window.contextmenuLatLng)
                                         .setContent(window.geofenceInput)
                                         .openOn(window.map);
                    document.getElementById('geofenceValue')
                            .addEventListener('keypress', (e) => {
                                if (e.key == 'Enter') {
                                    window.addCircle(window.contextmenuLatLng, document.getElementById('geofenceValue').value ?? 200)
                                    window.map.closePopup(geofencePopup);
                                }
                            });
                }
            },
            {
                text: 'Add Marker',
                callback: () => {
                    let markerNamePopup = L.popup()
                                           .setLatLng(window.contextmenuLatLng)
                                           .setContent(window.markerNameInput)
                                           .openOn(window.map);
                    document.getElementById('markerName')
                            .addEventListener('keypress', (e) => {
                                if (e.key == 'Enter') {
                                    let name = document.getElementById('markerName').value.length == 0 ? window.contextmenuLatLng.join(', ') : document.getElementById('markerName').value;
                                    window.addMarker(name, window.contextmenuLatLng);
                                    window.addTooltipToMarker(name, name);
                                    window.map.closePopup(markerNamePopup);
                                }
                            });
                }
            }
        ]
    });
    window.mapIcon['default'] = L.icon({
        iconUrl: "../images/marker-icon.png",
        iconSize: [29, 45],
        iconAnchor: [15, 47],
        popupAnchor: [0, 0],
        shadowUrl: "../images/marker-shadow.png",
        shadowSize: [37, 40],
        shadowAnchor: [12, 42],
    });
    window.mapIcon['building'] = L.icon({
        iconUrl: "../images/building-marker.png",
        iconSize: [60, 60],
        iconAnchor: [31, 57],
        popupAnchor: [0, 0],
        shadowUrl: "../images/marker-shadow.png",
        shadowSize: [37, 40],
        shadowAnchor: [12, 42],
    });
    window.mapIcon['truck'] = L.icon({
        iconUrl: "../images/truck-marker.png",
        iconSize: [60, 60],
        iconAnchor: [31, 57],
        popupAnchor: [0, 0],
        shadowUrl: "../images/marker-shadow.png",
        shadowSize: [37, 40],
        shadowAnchor: [12, 42],
    });


    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(window.map);

    window.map.on('click', (e) => {

    });
    window.map.on('contextmenu', function(e){
        window.contextmenuLatLng = [e.latlng.lat, e.latlng.lng];
    });
    geofances.forEach(el =>  {
        window.addMarker(el.name, el.latlng, 'building');
        window.addTooltipToMarker(el.name, el.name);
        window.addCircleToMarker(el.name, el.radius);
    });
};

window.addMarker = (name, latlon, type = 'default') => {
    let marker = {
        name: name,
        latlon: latlon,
        marker: L.marker(latlon, {
            icon: window.mapIcon[type],
        }).addTo(window.map),
    };
    window.mapMarkers.push(marker);
};

window.showMarker = (name) => {
    let result = undefined;
    window.mapMarkers.forEach(marker => {
        if (marker.name === name) {
            result =  marker;
        }
    });
    return result;
};

window.geofenceProcess = (e) => {
    console.log(e);
}

window.addCircle = (latlon = [], radius = 200, color = '#3388ff') => {
    L.circle(latlon, {
        radius: radius,
        color: color
    }).addTo(window.map);
}

window.addCircleToMarker = (name, radius = 200, color = '#3388ff') => {
    let marker = window.showMarker(name);
    window.addCircle(marker.latlon, radius, color);
}

window.addTooltipToMarker = (name, text = "This is tooltip", alwaysShow = false) => {
    let marker = window.showMarker(name);
    marker.marker.bindTooltip(text, {
        permanent: alwaysShow
    });
}

window.drawRoute = (latlonList, color = '#ff0000', withEndMarker = false, autoFitMap = false) => {
    let polyline = L.polyline(latlonList, {color: color}).addTo(window.map);
    if (withEndMarker) {
        L.marker(latlonList[latlonList.length-1], {
            icon: window.mapIcon['default'],
        }).addTo(window.map);
    }
    if (autoFitMap) {
        window.map.fitBounds(polyline.getBounds());
    }
}

window.clearMarkers = () => {
    window.mapMarkers.forEach(item => {
        item.marker.remove();
    });
    window.mapMarkers = [];
}

window.updatePosition = (name, latlng) => {
    let marker = window.showMarker(name);
    marker.marker.setLatLng(latlng);
}
