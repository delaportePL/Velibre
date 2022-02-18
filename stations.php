<?php
session_start();
if(!isset($_SESSION)){
    header('Location: index.php');
    exit;
}
require_once '_inc/parts/header.php';
require_once '_inc/parts/nav.php';


$jsonStations = json_encode(file_get_contents('http://localhost:3001/stations.php'));
// ici http://localhost:3001/ représente le api/index.php, il simule une forme d'appel à une API par URL
// echo'<pre>';var_dump($jsonStations);echo '</pre>';die;

?>

<div class="global-container">
    <h1>Carte des stations</h1>
    <h3>Bienvenue <?=$_SESSION['email']?></h3>

    <div class="map-container">
        <div id="station-info"></div>
        <div id="map">
        </div>

    </div>
</div>

<script>
    let jsonStations = JSON.parse(<?php echo $jsonStations; ?>);
</script>
<script src="js/map.js"></script>
<script src="js/stations.js"></script>

<?php
require_once '_inc/parts/footer.php';
?>