<?php
session_start();
require_once __DIR__ . '/_inc/parts/header.php';
require_once __DIR__ . '/_inc/parts/nav.php';

$jsonLocations = json_decode(file_get_contents(
    'http://localhost:3001/locations.php?user_id='.$_SESSION['user_id']
), true);
// echo '<pre>'; var_dump($jsonLocations); echo '</pre>';

?>

<div class="global-container">
    <div class="profile-container">
        <div class="profile-image">
            <!-- <i class="fa-solid fa-user"></i> -->
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
                <?php
                    
                    foreach($jsonLocations as $location){
                        //var_dump($location);
                        echo '<p>
                            Vous avez loué le vélo #' . $location['velo_id'] . 
                            ' du ' . $location['start'] . ' au ' . $location['end'] .
                        '</p>';
                    }

                ?>
            </div>
        </div>
    </div>


</div>

<?php
require_once __DIR__ . '/_inc/parts/footer.php';
?>