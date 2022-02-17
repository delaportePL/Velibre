<?php
session_start();
require_once '_inc/parts/header.php';
require_once '_inc/db/login.php';
processForm();
?>

<div class="global-container">
    <div class="form-container">
        
        <form method="POST">
            <h1>Connexion</h1>
                <label><b>Email</b></label>
                <input type="text" placeholder="Entrer votre email" name="email">
                

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password">

                <input type="submit" name="submit" value='Connexion' >
                <?php
                    
                    if(getErrors() !== null && count(getErrors())!==0){
                        
                        foreach($errors as $key => $value){
                            echo "<p style='color:red'>$value</p>";
                        }
                    }
                ?>
        </form>
    </div>
</div>

<?php

require_once '_inc/parts/footer.php';

?>