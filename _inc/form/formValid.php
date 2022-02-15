<?php

$GLOBALS['errors'] = [];

function isSubmitted():bool
{
    return isset($_POST['submit']);
}

function isValidLoginForm():bool
{
    $constraints = [
        'email' => [
            [
                'isValid' => isNotBlank(getValues()['email']),
                'message' => 'Veuillez entrer votre email',
            ],
            [
                'isValid' => isEmailValid(getValues()['email']),
                'message' => 'Email incorrect',
            ],
        ],
        'password' => [
            [
                'isValid' => isNotBlank(getValues()['password']),
                'message' => 'Veuillez entrer votre mot de passe',
            ],
            [
                'isValid' => checkUser(getValues()['email'], getValues()['password']),
                'message' => 'Mot de passe incorrect',
            ],
        ]
    ];

    return checkConstraints($constraints);
}

function checkConstraints($constraints):bool
{
    // echo '<pre>';
    // var_dump($constraints);
    // echo '</pre>';die;

    $validation = true;
    foreach($constraints as $constr){
        foreach($constr as $value){
            if(!$value['isValid']){
                $GLOBALS['errors'][] = $value['message'];
                $validation = false;
            }
        }
        
    }
    return $validation;
}

function isNotBlank(string|null|array $field):bool
{
    return !empty($field);
}

function isEmailValid(string|null $value):bool
{
    return filter_var($value, FILTER_VALIDATE_EMAIL);
}

function getValues():array
{
    return $_POST;
}

function getErrors()
{
    return $GLOBALS['errors'] ?? null;
}
?>