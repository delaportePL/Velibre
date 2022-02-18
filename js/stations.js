// console.log(jsonStations);

if(jsonStations.length > 0)
    jsonStations.forEach(station => {
        let number = station.available
        let available = number > 0 ? '<p class="available">'+number : '<p class="unavailable">Aucuns'
        
        L.marker([station.longitude, station.latitude], {icon: veloIcon}).addTo(map)
        .bindPopup(
            '<h3>Station ' + station.nom + '</h3>' +
            available + ' vélos disponibles<p>' +
            (number > 0 ? '<span id="louer">Louer un vélo</span>' : '')
        )
        .on('click', function(e){
            showStationInfo(e);
            
        });
    });


function showStationInfo(e){
    let louer = document.getElementById('louer');
    louer.addEventListener('click', function() {
        let url = "http://localhost:3001/createLocation.php";
        let request = new Request(url, {
            // url: url,
            method: 'POST',
            body: 'id=4',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }); 
        
        fetch(request).then((res) => {
            res.json()
        }).then(data => {
            console.log(data)
        });
        //console.log(louer);

    })
}


