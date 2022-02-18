<?php
session_start();
require_once  __DIR__ . '/../_inc/db/pdo.php';
header('Content-type: application/json'); 
//Cela permet de passer d'un en-tête HTTP de type par défaut html à un format de type json 

$locations = getAllLocations($_GET['user_id']);
$actualLocations=  $pastLocations= [];
foreach($locations as $location){
    if(is_null($location['end']))
        $actualLocations[] = $location;
    $pastLocations[] = $location;
}
$jsonLocations = json_encode(array($actualLocations, $pastLocations));
echo $jsonLocations;

function getAllLocations(int $user_id):array|bool
{
    $connection = dbConnection();
    $sql = "select * 
            from velibre.locations
            where locations.user_id = :user_id";
    $query = $connection->prepare($sql);
    $query->execute([
        'user_id' => $user_id,
    ]);

    return $query->fetchAll() ?? false;
}


?>