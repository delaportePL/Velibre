<?php
header("Access-Control-Allow-Origin: *" );
// require_once  __DIR__ . '/../_inc/db/pdo.php';
// header('Content-type: application/json'); 

// echo 'location créée';

echo json_encode(array('a'=>$_POST['id']));

function createLocation(){

}