<?php 
require_once '../_inc/db/pdo.php';
require_once '../_inc/db/login.php';

echo getUserByEmail('admin@admin.fr')? 'user existant':'user non existant';
echo checkUser('admin@admin.fr', 'admin') ? 'connecté' : 'connection raté';
//header('Location: login.php?erreur=1');
?>

