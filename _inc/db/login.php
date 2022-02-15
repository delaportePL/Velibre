<?php
require_once 'pdo.php';
require_once __DIR__ . '/../form/formValid.php';

function processForm():void
{
    if(isSubmitted() && isValidLoginForm()){
        $email = getValues()['email'];
        $password = getValues()['password'];
        if(checkUser($email, $password)){
            sessionStartVariables($email, $password);
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
    $sql = "select users.email, users.password from velibre.users where users.email = :email";
    $query = $connection->prepare($sql);
    $query->execute([
        'email' => $email,
    ]);

    return $query->fetch() ?? false;
}

function sessionStartVariables(string $email, string $password):void
{
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

}

?>