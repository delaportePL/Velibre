<?php
header("Access-Control-Allow-Origin: *" );
require_once  __DIR__ . '/../_inc/db/pdo.php';
 
$velo_id = findVelosByStation($_POST['station_id']);
createLocation($velo_id['id'], $_POST['user_id']);

echo json_encode(array('newVelosCount'=> 'valid'));


function findVelosByStation(int $station_id):array|bool
{
    $connection = dbConnection();
    $sql = "select id from velos 
            where velos.station_id = :station_id 
            limit 1";
    $query = $connection->prepare($sql);
    $query->execute([
        'station_id' => $station_id
    ]);
    return $query->fetch() ?? false;
}

function createLocation(int $velo_id, int $user_id):void
{
    $connection = dbConnection();
    $sql = "INSERT INTO locations (`velo_id`, `user_id`, `start`) 
            VALUES (:velo_id, :user_id, now())";
    $query = $connection->prepare($sql);
    $query->execute([
        'velo_id' => $velo_id,
        'user_id' => $user_id
    ]);
}

