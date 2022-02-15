<?php
session_start();
require_once '_inc/parts/header.php';
require_once '_inc/parts/nav.php';

?>

<div class="global-container">
    <h1>Carte des stations</h1>
    <h3>Bienvenue <?=$_SESSION['email']?></h3>
    <div class="map-container">
        
    </div>
</div>

<?php
require_once '_inc/parts/footer.php';
?>