<?php
require_once  __DIR__ . '/../_inc/db/pdo.php';
header('Content-type: application/json'); 
//Cela permet de passer d'un en-tête HTTP de type par défaut html à un format de type json 

$allStations = getAllStations();
echo json_encode($allStations);

function getAllStations():array|bool
{
    $connection = dbConnection();
    $sql = "select *, count(velos.id) as available from stations 
            left join velos on velos.station_id = stations.id 
            group by stations.id";
    $query = $connection->prepare($sql);
    $query->execute();

    return $query->fetchAll() ?? false;
}


// function getVelosByStation(int $station_id):array|bool
// {
//     $connection = dbConnection();
//     $sql = "select stations.nom, stations.longitude, stations.latitude 
//             from velibre.stations";
//     $query = $connection->prepare($sql);
//     $query->execute([
//         'station_id' => $station_id,
//     ]);

//     return $query->fetchAll() ?? false;
// }


?>