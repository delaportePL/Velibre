<?php
session_start();
if(!isset($_SESSION)){
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/_inc/parts/header.php';
require_once __DIR__ . '/_inc/parts/nav.php';

/*  ----- APPEL API -------
    -- LOCATIONS BY USER --
*/
$jsonLocations = json_decode(file_get_contents(
    'http://localhost:3001/locations.php?user_id='.$_SESSION['user_id']
), true);
// echo'<pre>';var_dump($jsonLocations);echo '</pre>';die;

?>

<div class="global-container">
    <div class="profile-container">
        <div class="profile-image">
            <i class="fa-solid fa-user fa-8x"></i>
        </div>
        <div class="profile-informations">
            <h3>Nom : <?= $_SESSION['nom'] ?></h3>
            <h3>Prénom : <?= $_SESSION['prenom'] ?></h3>
            <h3>Email : <?= $_SESSION['email'] ?></h3>
        </div>
    </div>
    <div class="location-container">
        <h1>Mes locations</h1>
        <div id="liste-locations">
            <div class="content">
                <h2>Locations en cours</h2>
                <?php 
                    if(empty($jsonLocations[0])){
                        echo '<p>Aucune location en cours</p>';
                    }else{
                        echo '<p>Vélo #' . $jsonLocations[0][0]['velo_id'] . 
                        ' depuis <span>' . date('d/m/Y à G:i', strtotime($jsonLocations[0][0]['start'])) . '</span></p>';
                    }
                ?>
                <h2>Locations passées</h2>
                <?php
                    foreach($jsonLocations[1] as $location){
                        echo '<p>Vélo #' . $location['velo_id'] . 
                        ' du <span>' .  date('d/m/Y à G:i', strtotime($location['start'])) . '</span> au <span>' . 
                        date('d/m/Y à G:i', strtotime($location['end'])) . '</span></p>';
                    }
                ?>
            </div>
        </div>
    </div>


</div>

<?php
require_once __DIR__ . '/_inc/parts/footer.php';
?>