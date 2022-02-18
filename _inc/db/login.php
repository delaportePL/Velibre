<?php
require_once 'pdo.php';
require_once __DIR__ . '/../form/formValid.php';

function processForm():void
{
    if(isSubmitted() && isValidLoginForm()){
        $email = getValues()['email'];
        $password = getValues()['password'];
        $userInformations = getUserInformations($email);
        if(checkUser($email, $password)){
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('Location: stations.php');
        }
    }
}

function checkUser(string $email, string $password):bool
{
    if(!getUserByEmail($email) || !password_verify($password, getUserByEmail($email)['password'])){
        return false;
    }

    return true;
}

function getUserByEmail(string $email):array|bool
{
    $connection = dbConnection();
    $sql = "select users.email, users.password, users.nom, users.prenom
            from velibre.users 
            where users.email = :email";
    $query = $connection->prepare($sql);
    $query->execute([
        'email' => $email,
    ]);

    return $query->fetch() ?? false;
}

function getUserInformations(string $email):void
{
    $connection = dbConnection();
    $sql = "select users.id, users.nom, users.prenom
            from velibre.users 
            where users.email = :email";
    $query = $connection->prepare($sql);
    $query->execute([
        'email' => $email,
    ]);
    $result = $query->fetch();

    $_SESSION['user_id'] = (int) $result['id'];
    $_SESSION['nom'] = $result['nom'];
    $_SESSION['prenom'] = $result['prenom'];
}


?>