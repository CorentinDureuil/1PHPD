<?php

include('../../initialize.php');

try {

    $make_call = callAPI('GET', 'http://localhost:3000/users/search', false);
    $response = json_decode($make_call, true);
    $data = $response;

    $q = $_REQUEST["q"];

    $hint = array();


    if ($q !== "") {
        $q = strtolower($q);
        $len = strlen($q);
        foreach($data as $line) {
            if (stristr($q, substr($line['last_name'], 0, $len)) && !in_array($line['id'], $hint)) {
                array_push($hint, $line['id']);
            }
        }
    }

    echo '<table id="border">
                <tr id="border">
                    <th id="border">ID de l\'utilisateur</th>
                    <th id="border">Nom - Prénom</th>
                    <th id="border">Adresse mail</th>
                    
                    <th id="border">Actions</th>          
                </tr>';

    if (empty($hint)) {
        $make_call = callAPI('GET', 'http://localhost:3000/users/getAllUsers', false);
        $response = json_decode($make_call, true);
        $data = $response;

        foreach($data as $user) {
            if($user['admin'] == 1) {
                $data_id = $user['id'] . " (admin)";
            } else {
                $data_id = $user['id'];
            }
            echo '<tr id="border">
                    <td id="border">'. $data_id .'</td>
                    <td id="border">' . $user['last_name'] . ' ' . $user['first_name'] . '</td>
                    <td id="border">' . $user['mail'] . '</td>
                    <td id="border">' .
                        '<form method="get" action="orders_history.php" >' .
                            '<button name="user_id" value="' . $user['id'] . '">Voir les commandes</button>'.
                        '</form>' .
                    '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }


    foreach ($hint as $user) {
        $make_call = callAPI('GET', 'http://localhost:3000/users/getUser?id=' . $user, false);
        $response = json_decode($make_call, true);
        $data = $response[0];

        if($data['admin'] == 1) {
            $data_id = $data['id'] . " (admin)";
        } else {
            $data_id = $data['id'];
        }

        echo '<tr id="border">
                <td id="border">'. $data_id .'</td>
                <td id="border">' . $data['last_name'] . ' ' . $data['first_name'] . '</td>
                <td id="border">' . $data['mail'] . '</td>
                <td id="border">' .
                    '<form method="get" action="orders_history.php" >' .
                        '<button name="user_id" value="' . $data['id'] . '">Voir les commandes</button>'.
                    '</form>' .
                '</td>';

        echo '</tr>';

    }

    echo '</table>';

} catch (PDOException $e) {
    print "Erreur TOTO: " . $e->getMessage() . "<br/>";
    die();
}