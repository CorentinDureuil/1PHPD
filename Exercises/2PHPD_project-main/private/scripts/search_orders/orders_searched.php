<?php

include('../../initialize.php');

try {

    $make_call = callAPI('GET', 'http://localhost:3000/orders/search', false);
    $response = json_decode($make_call, true);
    $data = $response;

    $q = $_REQUEST["q"];

    $hint = array();

    if ($q !== "") {
        $len = strlen($q);
        foreach($data as $line) {
            if (substr($line['id'], 0, $len) == $q) {
                array_push($hint, $line['id']);
            }
        }
    }

    echo '<table id="border">
                <tr id="border">
                    <th id="border">Commande n°</th>
                    <th id="border">Nom - Adresse de livraison</th>
                    <th id="border">Prix de la commande</th>
                    <th colspan="3">Actions</th>
                    <th> </th>          
                </tr>';

    if (empty($hint)) {
        $make_call = callAPI('GET', 'http://localhost:3000/orders/getAllOrders', false);
        $response = json_decode($make_call, true);
        $data = $response;

        foreach($data as $order) {
            $make_call = callAPI('GET', 'http://localhost:3000/users/getInfos?id=' . $order['user_id'], false);
            $response = json_decode($make_call, true);
            $details = $response[0];

            echo '<tr id="border">
                <td id="border">'. $order['id'] .'</td>
                <td id="border">' . $details['first_name'] . ' ' . $details['last_name'] . '<br/>' . $details['delivery_address'] . ' - ' . $details['delivery_city'] . '</td>
                <td id="border">' . $order['total_price'] . ' &euro;</td>
                <td>' .
                    '<div id="action_buttons">
                        <form method="post" action="order_details.php" >' .
                            '<button name="order_id" value="' . $order['id'] . '">Plus de détails</button>'.
                        '</form>' .
                        '<form method="post" action="../private/functions.php" >' .
                            '<button name="get_pdf" value="' . $order['id'] . '">Obtenir le PDF</button>'.
                        '</form>';

            if($order['finished'] == 0) {
                echo '<form method="get" action="../private/functions.php" >' .
                        '<button name="finish_order" value="' . $order['id'] . '">Terminer la commande</button>'.
                     '</form>' ;
            }
            echo '</div></td></tr>';
        }
        echo '</table>';
    }


    foreach ($hint as $product) {
        $make_call = callAPI('GET', 'http://localhost:3000/orders/getOrder?id=' . $product, false);
        $response = json_decode($make_call, true);
        $data = $response[0];

        $make_call = callAPI('GET', 'http://localhost:3000/users/getInfos?id=' . $data['user_id'], false);
        $response = json_decode($make_call, true);
        $details = $response[0];

        echo '<tr id="border">
                <td id="border">'. $product .'</td>
                <td id="border">' . $details['first_name'] . ' ' . $details['last_name'] . '<br/>' . $details['delivery_address'] . ' - ' . $details['delivery_city'] . '</td>
                <td id="border">' . $data['total_price'] . ' &euro;</td>
                <td>' .
                    '<div id="action_buttons">
                        <form method="post" action="order_details.php" >' .
                            '<button name="order_id" value="' . $product . '">Plus de détails</button>'.
                        '</form>' .
                        '<form method="post" action="../private/functions.php" >' .
                            '<button name="get_pdf" value="' . $product . '">Obtenir le PDF</button>'.
                        '</form>';

        if($data['finished'] == 0) {
            echo '<form method="get" action="../private/functions.php" >' .
                    '<button name="finish_order" value="' . $product . '">Terminer la commande</button>'.
                 '</form>';

        }
        echo '</div></td></tr>';
    }

    echo '</table>';

} catch (PDOException $e) {
    print "Erreur TOTO: " . $e->getMessage() . "<br/>";
    die();
}