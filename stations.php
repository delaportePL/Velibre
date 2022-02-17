<?php
session_start();
require_once '_inc/parts/header.php';
require_once '_inc/parts/nav.php';

$jsonStations = json_encode(file_get_contents('http://localhost:3001/stations.php'));

// $jsonStations = file_get_contents('http://localhost:3001/stations.php');

// ici http://localhost:3001/ représente le api/index.php, il simule une forme d'appel à une API par URL

?>

<div class="global-container">
    <h1>Carte des stations</h1>
    <h3>Bienvenue <?=$_SESSION['email']?></h3>

    <div class="map-container">
        <div id="map">

        </div>

    </div>
</div>

<script>
    var jsonStations = JSON.parse(<?php echo $jsonStations; ?>);
    console.log(jsonStations);
</script>
<script src="js/map.js"></script>
<script src="js/stations.js"></script>

<?php
require_once '_inc/parts/footer.php';
?>