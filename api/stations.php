<?php
require_once  __DIR__ . '/../_inc/db/pdo.php';
header('Content-type: application/json'); 
//Cela permet de passer d'un en-tête HTTP de type par défaut html à un format de type json 

echo json_encode(getAllStations());

function getAllStations():array|bool
{
    $connection = dbConnection();
    $sql = "select * 
            from velibre.stations";
    $query = $connection->prepare($sql);
    $query->execute();

    return $query->fetchAll() ?? false;
}

// function getStationsByCity($city):array|bool
// {
//     $connection = dbConnection();
//     $sql = "select stations.nom, stations.xAxis, stations.yAxis 
//             from velibre.stations
//             where stations.xAxis between :xAxisDown and :xAxisUp
//             and where ";
//     $query = $connection->prepare($sql);
//     $query->execute();

//     return $query->fetchAll() ?? false;
// }

function getVelosByStation(int $station_id):array|bool
{
    $connection = dbConnection();
    $sql = "select stations.nom, stations.xAxis, stations.yAxis 
            from velibre.stations";
    $query = $connection->prepare($sql);
    $query->execute([
        'station_id' => $station_id,
    ]);

    return $query->fetchAll() ?? false;
}


?>