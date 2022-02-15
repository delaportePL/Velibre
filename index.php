<?php
require_once '_inc/header.php';
require_once '_inc/nav.php';
?>

<div class="global-container">
    <div class="form-container">
        
        <form action="api/index.php" method="POST">
            <h1>Connexion</h1>
                <label><b>Email</b></label>
                <input type="text" placeholder="Entrer votre email" name="email" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='Connexion' >
                <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2)echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                ?>
        </form>
    </div>
</div>

<?php
require_once '_inc/footer.php';
?>