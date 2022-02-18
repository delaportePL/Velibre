<?php
require_once  __DIR__ . '/../_inc/db/pdo.php';
header('Content-type: application/json'); 
//Cela permet de passer d'un en-tête HTTP de type par défaut html à un format de type json 

$allStations = getAllStations();
$velosIndispos = getVelosUnavailable();
foreach($velosIndispos as $velo){
    $matchIndex = array_search($velo['station_id'], array_column($allStations, 'station_id'));
    $allStations[$matchIndex]['available'] -= $velo['unavailable'];
}
echo json_encode($allStations);

function getAllStations():array|bool
{
    $connection = dbConnection();
    $sql = "select *, count(velos.id) as available 
            from stations 
            left join velos on velos.station_id = stations.id
            group by stations.id";
    $query = $connection->prepare($sql);
    $query->execute();

    return $query->fetchAll() ?? false;
}

function getVelosUnavailable():array|bool
{
    $connection = dbConnection();
    $sql = "select velos.station_id, count(velos.id) as unavailable 
            from locations 
            join velos on velos.id = locations.velo_id 
            group by velos.station_id";
    $query = $connection->prepare($sql);
    $query->execute();

    return $query->fetchAll() ?? false;
}

?>