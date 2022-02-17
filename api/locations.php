<?php
require_once  __DIR__ . '/../_inc/db/pdo.php';
header('Content-type: application/json'); 
//Cela permet de passer d'un en-tête HTTP de type par défaut html à un format de type json 
$jsonLocations = json_encode(getAllLocations($_GET['user_id']));
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