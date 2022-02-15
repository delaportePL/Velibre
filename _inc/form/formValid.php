<?php

$GLOBALS['errors'] = [];

function processForm():void
{
    if(isSubmitted() && isValid()){
        echo 'Formulaire soumis et valide';
    }
}

function isSubmitted():bool
{
    return isset($_POST['submit']);
}

function isValid():bool
{
    $constraints = [
        'email' => [
            'isValid' => isEmailValid(getValues()['email']),
            'message' => 'Email incorrect',
        ],
        'password' => [
            'isValid' => true,
            'message' => 'Mot de passe incorrect',
        ]
    ];

    return checkConstraints($constraints);
}

function checkConstraints($constraints):bool
{
    $validation = true;
    foreach($constraints as $key => $value){
        if(!$value['isValid']){
            $validation = false;
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
    return preg_match('/[\w|\d]+\@[\w|\d]+\.\w+/', $value);
}

function getValues():array
{
    return $_POST;
}

?>