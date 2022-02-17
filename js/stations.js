if(jsonStations.length > 0)
    jsonStations.forEach(station => {
        L.marker([station.xAxis, station.yAxis], {icon: veloIcon}).addTo(map)
        .bindPopup('<h1>Station ' + station.nom + '</h1>')
        .on('click', function(e){
            showStationInfo(e);
        });
    });


function showStationInfo(e){
    
    
    
    return e;
}


// L.marker([48.83678885, 2.241514541515], {icon: veloIcon}).addTo(map)
// .bindPopup('Station x')
// .openPopup();
