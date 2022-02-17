var mapId = 'map';
var xAxis = 48.85682201061653;
var yAxis = 2.350871578722915;
var zoomLevel = 12;

var veloIcon = L.icon({
    iconUrl: 'img/logo_velo.png',
    iconSize:     [60, 60],
    iconAnchor:   [30, 60],
    popupAnchor:  [0, -60]
});

map = L.map(mapId).setView([xAxis, yAxis], zoomLevel);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);







