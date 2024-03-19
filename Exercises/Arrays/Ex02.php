<?php

$users = [
    [
        "id" => 1,
        "firstname" => "Corentin",
        "lastname" => "DUREUIL",
        "age" => 21,
        "address" => [
            "zipcode" => "59000",
            "city" => "Lille",
            "street" => "Place Rihour"
        ]
    ],
    [
        "id" => 2,
        "firstname" => "Jean",
        "lastname" => "Küll",
        "age" => 70,
        "address" => [
            "zipcode" => "69000",
            "city" => "Lyon",
            "street" => "Place des Momans"
        ]
    ],
];


function displayUserInfo($users, $userId) {
    foreach ($users as $user) {
        if ($user['id'] === $userId) {
            foreach ($user as $key => $value) {
                if ($key !== 'id' && is_array($value)) {
                    echo ucfirst($key) . ": <br/>";
                    foreach ($value as $subKey => $subValue) {
                        echo "  " . ucfirst($subKey) . ": " . $subValue . "<br/>";
                    }
                } elseif ($key !== 'id') {
                    echo ucfirst($key) . ": " . $value . "<br/>";
                }
            }
            break;
        }
    }
}

echo "Informations de l'utilisateur: </br>";
displayUserInfo($users, 1);
