<?php
require_once 'pdo.php';
require_once '../form/formValid.php';

function getUserByEmail(string $email):array|bool
{
    $connection = dbConnection();
    $sql = "select users.email, users.password from velibre.users where users.email = :email";
    $query = $connection->prepare($sql);
    $query->execute([
        'email' => $email,
    ]);
    return $query->fetch() ?? false;
}

function checkUser(string $email, string $password):bool
{
    if(!getUserByEmail($email) || !password_verify($password, getUserByEmail($email)['password'])){
        return false;
    }

    return true;
}

function processForm():void
{
    if(isSubmitted() && isValidLoginForm()){
        if(checkUser(getValues()['email'], getValues()['password'])){
            echo 'Utilisateur authentifié';
        }
    }
}

?>