<?php

function dbConnection():PDO
{
    $connection = new PDO('mysql:host=127.0.0.1; dbname=velibre', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $connection;
}
?>