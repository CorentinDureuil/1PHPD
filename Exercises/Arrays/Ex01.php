<?php

$user = [
    "firstname" => "Corentin",
    "lastname" => "DUREUIL",
    "age" => 21,
    "address" => [
        "zipcode" => "59000",
        "city" => "Lille",
        "street" => "Place Rihour"
    ]
];

function displayUserInfo($item, $indent = "") {
    if (is_array($item)) {
        foreach ($item as $key => $value) {
            if (is_array($value)) {
                echo $indent . ucfirst($key) . ": <br/>";
                displayUserInfo($value, $indent . "  ");
            } else {
                echo $indent . ucfirst($key) . ": " . $value . "<br/>";
            }
        }
    } else {
        echo $indent . $item . "<br/>";
    }
}

echo "Informations de l'utilisateur: </br>";
displayUserInfo($user);
