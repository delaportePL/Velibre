
if(jsonStations.length > 0)
    //let in_use = window.sessionStorage.getItem('in_use');
    jsonStations.forEach(station => {
        let number = station.available
        let available = number > 0 ? '<p class="available">'+number : '<p class="unavailable">Aucuns';
        console.log(in_use)
        L.marker([station.longitude, station.latitude], {icon: veloIcon, station_id: station.station_id}).addTo(map)
        .bindPopup(
            '<h3>Station ' + station.nom + '</h3>' +
            available + ' vélos disponibles<p>' +
            ((number > 0 && in_use == 0) ? '<span id="louer">Louer un vélo</span>' : (in_use > 0) ? '<span>Veuillez rendre votre vélo en cours</span>' : '')
        )
        .on('click', function(){
            let station_id = this.options.station_id;
            louerVelo(station_id);
        });
    });


function louerVelo(station_id){
    let user_id = window.sessionStorage.getItem('user_id');
    let louer = document.getElementById('louer');
    
    louer.addEventListener('click', function() {
        let url = "http://localhost:3001/createLocation.php";
        let request = new Request(url, {
            method: 'POST',
            body: 'station_id='+station_id+'&user_id=' + user_id,
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


